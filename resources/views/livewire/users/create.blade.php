<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
	<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
		<div class="fixed inset-0 transition-opacity" aria-hidden="true">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>

		<!-- This element is to trick the browser into centering the modal contents. -->
		<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

		<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-5xl sm:my-8 sm:align-middle w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
			<form class="">
                <div class="bg-gray-50 px-4 py-6 sm:px-8 sm:flex sm:flex-row-reverse">
                    <div class="w-full">
						<h3 class="text-3xl font-normal text-primary" id="modal-headline">
							Create new user
						</h3>
                    </div>
                </div>

				<div class="bg-white p-6 sm:py-8 sm:px-16">
                    <div class="flex justify-between space-x-6">
                        <div class="w-full mb-6">
                            <x-jet-label for="first_name" value="{{ __('First Name') }}*"><span class="text-primary text-sm">*</span></x-jet-label>
                            <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name" autofocus />
                            <x-jet-input-error for="first_name" class="mt-2" />
                        </div>

                        <div class="w-full mb-6">
                            <x-jet-label for="last_name" value="{{ __('Last Name') }}*" />
                            <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" />
                            <x-jet-input-error for="last_name" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-between space-x-6">
                        <div class="w-full mb-6">
                            <x-jet-label for="email" value="{{ __('Email') }}*" />
                            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>

                        <div class="w-full mb-6">
                            <x-jet-label for="company_name" value="{{ __('Company Name') }}*" />
                            <x-jet-input id="company_name" type="text" class="mt-1 block w-full" wire:model.defer="company_name" />
                            <x-jet-input-error for="company_name" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-between space-x-6">
                        <div class="w-full mb-6">
                            <x-jet-label for="password" value="{{ __('Password') }}*"></x-jet-label>
                            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="password" />
                            <x-jet-input-error for="password" class="mt-2" />
                        </div>

                        <div class="w-full mb-6">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}*"></x-jet-label>
                            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="password_confirmation" />
                            <x-jet-input-error for="password_confirmation" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-between space-x-6">
                        <div class="w-full mb-6">
                            <x-jet-label for="role" value="{{ __('Role') }}*" />
                            <select class="form-control rounded-md shadow-sm border border-gray-300 text-gray-500 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50 w-full h-10" wire:model="role" id="role">
                                <option value="" class="text-gray-300" selected>Select</option>

                                @foreach ($allRoles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
				</div>

				@include('livewire.create-modal-buttons')
			</form>
		</div>
	</div>
</div>
