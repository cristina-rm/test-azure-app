<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends ParentComponent
{
    use WithPagination;

    public $name, $guard_name, $role_id, $role;
    protected $roles;
    public $allPermissions;
    public $selectedPermissions = [];
    public $deleteId = '';

    public function render()
    {
        $this->roles = Role::latest()->paginate(10);
        $this->allPermissions = Permission::all();
        $this->guard_name = 'web';

        return view('livewire.roles.list', [
            'roles' => $this->roles,
            'guard_name' => $this->guard_name,
            'allPermissions' => $this->allPermissions
        ]);
    }

    /**
     * Reset values to their initial state.
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->selectedPermissions = [];
        $this->role = '';
        $this->role_id = '';
        $this->deleteId = '';
    }

    /**
     * Show a resource from the database.
     *
     * @param int $id
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        $this->role = $role;
        $this->role_id = $id;
        $this->name = $role->name;

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
        $role = Role::findOrFail($id);

        $this->role_id = $id;
        $this->role = $role;
        $this->selectedPermissions = $role->permissions->pluck('id', 'id')->toArray();
        $this->name = $role->name;

        $this->openEditModal();
    }

    /**
     * Store a resource in the database.
     */
    public function store()
    {
        $this->validate([
            'name' => 'required|string:255|unique:roles,name'
        ]);

        $role = Role::create([
            'name' => $this->name,
            'guard_name' => $this->guard_name
        ]);

        // Bind selected permission to role
        $role->permissions()->sync($this->selectedPermissions);
        session()->flash('message', 'Role successfully created.');

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
            'name' => 'required|string:255'
        ]);

        $role = Role::findOrFail($this->role_id);
        $role->name = $this->name;
        $role->save();

        // Bind selected permission to role
        $role->permissions()->sync(array_filter($this->selectedPermissions));

        session()->flash('message', 'Role successfully updated.');
        $this->closeEditModal();
        $this->resetInputFields();
        $this->emit('refreshLivewireDatatable');
    }

    /**
     * Bind role id to delete.
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
        Role::find($this->deleteId)->delete();

        $this->resetInputFields();
        $this->closeConfirmDeleteModal();
        $this->emit('refreshLivewireDatatable');
        session()->flash('message', 'Role successfully deleted.');
    }
}
