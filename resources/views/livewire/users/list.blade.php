<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Users') }}
    </h2>
</x-slot>

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap content-end">
            <button wire:click="create()" onclick="showBodyScroll(false)" class="bg-primary text-white py-2 px-4 rounded text-base mb-4 focus:outline-none focus:ring-red-300">Add user</button>
        </div>

        @if($showIsOpen)
            @include('livewire.users.show')
        @endif

        @if($createIsOpen)
            @include('livewire.users.create')
        @endif

        @if($editIsOpen)
            @include('livewire.users.edit')
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
             <livewire:users-datatable exportable />
        </div>
    </div>
</div>
