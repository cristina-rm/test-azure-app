<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Roles') }}
    </h2>
</x-slot>

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap content-end">
            <button wire:click="create()" onclick="showBodyScroll(false)" class="bg-primary text-white py-2 px-4 rounded text-base mb-4 focus:outline-none focus:ring-red-300">Add role</button>
        </div>

        @if($showIsOpen)
            @include('livewire.roles.show')
        @endif

        @if($createIsOpen)
            @include('livewire.roles.create')
        @endif

        @if($editIsOpen)
            @include('livewire.roles.edit')
        @endif

        @if($confirmDeleteIsOpen)
            @include('livewire.confirm-delete')
        @endif

        @if (session()->has('message'))
            <div class="rounded-b bg-green-100 text-teal-900 px-4 py-3 my-3" role="alert">
                <div class="flex">
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        @endif

         <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10 garage-datatable">
             <livewire:roles-datatable />
            {{--<table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left w-8">#ID</th>
                        <th class="py-3 px-6 text-center">Name</th>
                        <th class="py-3 px-6 text-center">Guard name</th>
                        <th class="py-3 px-6 text-center w-36">Created at</th>
                        <th class="py-3 px-6 text-center w-26">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($roles as $role)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $role->id }}</td>
                            <td class="py-3 px-6 text-center">{{ $role->name }}</td>
                            <td class="py-3 px-6 text-center">{{ $role->guard_name }}</td>
                            <td class="py-3 px-6 text-center">{{ $role->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex item-center justify-center">
                                    <button wire:click="show({{ $role->id }})" class="text-gray-500 hover:text-purple-500 text-white font-bold p-1 rounded">
                                        <i class="far fa-eye"></i>
                                    </button>

                                    <button wire:click="edit({{ $role->id }})" class="text-gray-500 hover:text-purple-500 text-white font-bold p-2 rounded">
                                        <i class="far fa-edit"></i>
                                    </button>

                                    <button wire:click="delete({{ $role->id }})" class="text-gray-500 hover:text-purple-500 text-white font-bold p-1 rounded"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-5">
                {{ $roles->links() }}
            </div>--}}
        </div>
    </div>
</div>
