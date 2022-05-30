<div class="flex item-center justify-center">
    <button wire:click="$emit('showAction', {{ $id }})" onclick="showBodyScroll(false)" class="text-gray-500 hover:text-primary font-bold p-1 rounded">
        <i class="far fa-eye"></i>
    </button>

    <button wire:click="$emit('editAction', {{ $id }})" onclick="showBodyScroll(false)" class="text-gray-500 hover:text-primary font-bold p-2 rounded">
        <i class="far fa-edit"></i>
    </button>

    <button {{--wire:click="$emit('deleteAction', {{ $id }})"--}} type="button" wire:click="$emit('confirmDeleteAction', {{ $id }})" class="text-gray-500 hover:text-primary font-bold p-1 rounded"><i class="far fa-trash-alt"></i></button>
</div>
