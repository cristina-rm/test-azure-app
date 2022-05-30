<?php

namespace App\Http\Livewire; 

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Profile;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $authUser = Auth::user()->withoutRelations()->toArray();
        $user = Auth::user();

        if (!$user->profile) {
            Profile::create([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'user_id' => $user->id,
                'company_name' => 'Your Company'
            ]);

            // Assign role to user
            $user->assignRole(4); // User

            // Bind role's permissions to user
            $permissions = $user->getPermissionsViaRoles();
            $user->syncPermissions($permissions);
        }

        $profile = $user->profile->toArray();

        $this->state = array_merge($authUser, $profile);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        if (isset($this->photo)) {
            return redirect()->route('profile.show');
        }

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.update-profile-information-form');
    }
}
