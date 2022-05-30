<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
	<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
		<div class="fixed inset-0 transition-opacity" aria-hidden="true">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>

		<!-- This element is to trick the browser into centering the modal contents. -->
		<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

		<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-4xl sm:my-8 sm:align-middle w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
			<form class="">
                <div class="bg-gray-50 px-4 py-6 sm:px-8 sm:flex sm:flex-row-reverse">
                    <div class="w-full">
						<h3 class="text-3xl font-normal text-primary" id="modal-headline">
                            Edit permission
						</h3>
                    </div>
                </div>

				<div class="bg-white p-6 sm:py-8 sm:px-16">
                    <div class="w-2/3 mb-6">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" :value="old('name')" autofocus />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="w-2/3 my-6">
                        <x-jet-label for="roles" value="{{ __('Roles') }}" />

                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($allRoles as $role)
                                <label class="flex items-center">
                                    <x-jet-checkbox wire:model.defer="selectedRoles.{{ $role->id }}" :value="$role->id" />
                                    <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
				</div>

				@include('livewire.edit-modal-buttons')
			</form>
		</div>
	</div>
</div>
