<?php

namespace App\Http\Livewire;

use Spatie\Permission\Models\Permission;
use Mediconesystems\LivewireDatatables\{
    Http\Livewire\LivewireDatatable,
    Column,
    NumberColumn,
    DateColumn
};

class PermissionsDatatable extends LivewireDatatable
{
    public $model = Permission::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')
                ->label('Name')
                ->searchable(),
            DateColumn::name('created_at')
                ->label('Date created')
                ->searchable(),
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('livewire.table-actions', ['id' => $id, 'name' => $name]);
            })->label('Actions')
        ];
    }
}
