<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Spatie\Activitylog\Models\Activity;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'company_name' => ['nullable', 'string', 'max:255']
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['first_name'].' '.$input['last_name'],
                'email' => $input['email'],
            ])->save();

            $user->profile->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'company_name' => $input['company_name']
            ])->save();
        }

        // Log update activity
        $updatedUserFields = array_keys($user->getChanges());
        $updatedCompanyFields = array_keys($user->profile->getChanges());
        array_pop($updatedUserFields);

        foreach ($updatedUserFields as $key) {
            $propertiesToLog[$key] = $user[$key];
        }

        if (in_array('company_name', $updatedCompanyFields)) {
            $propertiesToLog['company_name'] = $input['company_name'];
        }

        activity()
           ->performedOn($user)
           ->causedBy(auth()->user())
           ->withProperties($propertiesToLog)
           ->log('updated');

        $lastActivity = Activity::all()->last();
        $lastActivity->log_name = 'system';
        $lastActivity->save();

        session()->flash('message', 'Profile successfully updated.');
        redirect()->route('profile.show');
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['first_name'].' '.$input['last_name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
