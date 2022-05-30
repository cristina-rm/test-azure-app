<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permissions extends ParentComponent
{
    use WithPagination;

    public $name, $guard_name, $permission_id, $permission;
    protected $permissions;
    public $allRoles;
    public $selectedRoles = [];
    public $deleteId = '';

    public function render()
    {
        $this->permissions = Permission::latest()->paginate(10);
        $this->allRoles = Role::all();
        $this->guard_name = 'web';

        return view('livewire.permissions.list', [
            'permissions' => $this->permissions,
            'allRoles' => $this->allRoles,
            'guard_name' => $this->guard_name
        ]);
    }

    /**
     * Reset values to their initial state.
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->selectedRoles = [];
        $this->permission = '';
        $this->permission_id = '';
        $this->deleteId = '';
    }

    /**
     * Show a resource from the database.
     *
     * @param int $id
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        $this->permission = $permission;
        $this->permission_id = $id;
        $this->name = $permission->name;

        $this->openShowModal();
    }

    /**
     * Display a form for create new resource.
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openCreateModal();
    }

    /**
     * Display a form for edit new resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        $this->permission_id = $id;
        $this->permission = $permission;
        $this->selectedRoles = $permission->roles->pluck('id', 'id')->toArray();
        $this->name = $permission->name;

        $this->openEditModal();
    }

    /**
     * Store a resource in the database.
     */
    public function store()
    {
        $this->validate([
            'name' => 'required|string:255|unique:permissions,name'
        ]);

        $permission = Permission::create([
            'name' => $this->name,
            'guard_name' => $this->guard_name
        ]);

        // Bind permission to selected roles
        $permission->roles()->sync($this->selectedRoles);
        session()->flash('message', 'Permission successfully created.');

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

        $permission = Permission::findOrFail($this->permission_id);
        $permission->name = $this->name;
        $permission->save();

        // Bind permission to selected roles
        $permission->roles()->sync(array_filter($this->selectedRoles));

        session()->flash('message', 'Permission successfully updated.');
        $this->closeEditModal();
        $this->resetInputFields();
        $this->emit('refreshLivewireDatatable');
    }

    /**
     * Bind permission id to delete.
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
        Permission::find($this->deleteId)->delete();

        $this->resetInputFields();
        $this->closeConfirmDeleteModal();
        $this->emit('refreshLivewireDatatable');
        session()->flash('message', 'Permission successfully deleted.');
    }
}
