<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
    <button type="button" wire:click="update()" onclick="showBodyScroll(true)" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-200 sm:ml-3 sm:w-auto sm:text-sm">
    Save
    </button>

    <button type="button" wire:click="closeEditModal()" onclick="showBodyScroll(true)" class="mt-3 w-full inline-flex justify-center rounded-md border border-red-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-primary hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
    Cancel
    </button>
</div>
