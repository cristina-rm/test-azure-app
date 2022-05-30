<?php

namespace App\Http\Livewire;

use App\Models\User;
use Auth;
use Mediconesystems\LivewireDatatables\{
    Http\Livewire\LivewireDatatable,
    Column,
    NumberColumn,
    DateColumn
};

class UsersDatatable extends LivewireDatatable
{
    public $model = User::class;

    public function builder()
    {
        $adminUserIds = User::whereHas("roles", function($q) {
            $q->where("name", "Admin");
        })->pluck('id')->toArray();

        // if admin => see all users
        $query = User::query()->leftJoin('profiles', 'users.id', 'profiles.user_id')
            ->leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id');

        // if manager => see all activities except admins
        if (Auth::user()->hasRole(['User Manager'])) {
            return $query->whereNotIn('user_id', $adminUserIds);
        }

        return $query;
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('profiles.first_name')
                ->label('First name')
                ->searchable(),
            Column::name('profiles.last_name')
                ->label('Last name')
                ->searchable(),
            Column::name('email')
                ->label('Email')
                ->searchable(),
            Column::name('profiles.company_name')
                ->label('Company name')
                ->searchable(),
            Column::name('roles.name')
                ->label('Role'),
            DateColumn::name('created_at')
                ->label('Date created')
                ->searchable(),
            Column::callback(['id'], function ($id) {
                return view('livewire.table-actions', ['id' => $id]);
            })->label('Actions')
        ];
    }
}
