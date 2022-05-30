<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Str;
use Spatie\Activitylog\Models\Activity;

class Users extends ParentComponent
{
    use WithPagination;

    public $first_name, $last_name, $email, $password, $password_confirmation, $user_id, $user;
    protected $users;
    public $allRoles;
    public $role = '';
    public $company_name = '';
    public $deleteId = '';

    public function render()
    {
        $this->users = User::latest()->paginate(10);
        $this->allRoles = Role::all();

        return view('livewire.users.list', [
            'users' => $this->users,
            'allRoles' => $this->allRoles
        ]);
    }

    /**
     * Reset values to their initial state.
     */
    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->company_name = '';
        $this->user_id = '';
        $this->user = '';
        $this->deleteId = '';
    }

    /**
     * Show a resource from the database.
     *
     * @param int $id
     */
    public function show($id)
    {
        $user = User::with('profile', 'roles')->where('id', $id)->first();

        $this->user = $user;
        $this->first_name = $user->profile->first_name;
        $this->last_name = $user->profile->last_name;
        $this->email = $user->email;
        $this->company_name = $user->profile->company_name;
        $this->role = $user->getRoleNames()->first();

        $this->openShowModal();
    }

    /**
     * Display a form for create a resource.
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openCreateModal();
    }

    /**
     * Display a form for edit a resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $user = User::with('profile', 'roles')->where('id', $id)->first();

        $this->user_id = $id;
        $this->user = $user;
        $this->first_name = $user->profile->first_name;
        $this->last_name = $user->profile->last_name;
        $this->email = $user->email;
        $this->company_name = $user->profile->company_name;
        $this->role = $user->roles->first()->id;

        $this->openEditModal();
    }

    /**
     * Store a resource in the database.
     */
    public function store()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users,email',
			'password' => 'required|string|max:255|confirmed|min:6',
            'company_name' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $this->first_name.' '.$this->last_name,
            'email' => $this->email,
//            'uuid' => strtoupper(Str::random(6)),
            'password' => Hash::make($this->password)
        ]);

        Profile::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user_id' => $user->id,
            'company_name' => $this->company_name
        ]);

        // Assign role to user
        $user->assignRole($this->role);

        // Bind role's permissions to user
        $permissions = $user->getPermissionsViaRoles();
        $user->syncPermissions($permissions);

        session()->flash('message', 'User successfully created.');
        $this->closeCreateModal();
        $this->resetInputFields();
        $this->emit('refreshLivewireDatatable');
    }

    /**
     * Update a resource in the database.
     */
    public function update()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'company_name' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($this->user_id);
        $user->name = $this->first_name.' '.$this->last_name;
        $user->email = $this->email;
        $user->save();
        $oldRole = $user->roles->first()->id;

        $user->profile->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company_name' => $this->company_name
        ]);

        // Bind selected role to user
		$user->syncRoles($this->role);

        // Bind role's permissions to user
        $permissions = $user->getPermissionsViaRoles();
        $user->syncPermissions($permissions);

        // Log update activity
        $updatedUserFields = array_keys($user->getChanges());
        $updatedCompanyFields = array_keys($user->profile->getChanges());

        array_pop($updatedUserFields);

        foreach ($updatedUserFields as $key) {
            $propertiesToLog[$key] = $user[$key];
        }

        if (in_array('company_name', $updatedCompanyFields)) {
            $propertiesToLog['company_name'] = $this->company_name;
        }

        if ($oldRole != $this->role) {
            $propertiesToLog['role'] = Role::find($this->role)->name;
        }

        activity()
           ->performedOn($user)
           ->causedBy(auth()->user())
           ->withProperties($propertiesToLog)
           ->log('updated');

        $lastActivity = Activity::all()->last();
        $lastActivity->log_name = 'system';
        $lastActivity->save();

        session()->flash('message', 'User successfully updated.');
        $this->closeEditModal();
        $this->resetInputFields();
        $this->emit('refreshLivewireDatatable');
    }

    /**
     * Bind user id to delete.
     *
     * @param int $id
     */
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->openConfirmDeleteModal();
    }

    /**
     * Delete a resource from the database.
     *
     * @param int $id
     */
    public function delete()
    {
        User::find($this->deleteId)->delete();

        $this->resetInputFields();
        $this->closeConfirmDeleteModal();
        $this->emit('refreshLivewireDatatable');
        session()->flash('message', 'User successfully deleted.');
    }
}
