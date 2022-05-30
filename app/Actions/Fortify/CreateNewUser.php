<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // 'prefix' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['first_name'].' '.$input['last_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                // 'UUID' => Str::uuid()
            ]);

            Profile::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'company_name' => $input['company_name'],
                'user_id' => $user->id
            ]);

            // Assign role to user
            $user->assignRole(4); // User

            // Bind role's permissions to user
            $permissions = $user->getPermissionsViaRoles();
            $user->syncPermissions($permissions);

            return tap($user, function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
