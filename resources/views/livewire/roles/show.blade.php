<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
	<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
		<div class="fixed inset-0 transition-opacity" aria-hidden="true">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>

		<!-- This element is to trick the browser into centering the modal contents. -->
		<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

		<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-gray-50 px-4 py-6 sm:px-8 sm:flex sm:flex-row-reverse">
                <div class="w-full">
                    <h3 class="text-3xl font-normal text-primary" id="modal-headline">
                        Show role
                    </h3>
                </div>
            </div>

            <div class="bg-white p-6 sm:py-10 sm:px-10">
                <h4 class="text-xl font-semibold pb-2">Name</h4>
                <p class="font-semibold text-gray-600">{{ $role->name }}</p>

                <h4 class="text-xl font-semibold pt-12 pb-4">Permissions</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:w-2/3 pl-10">
                    @foreach($role->permissions as $permission)
                        <div class="mb-1">
                            <span class="inline-flex items-center justify-center py-1 px-3 text-xs text-white bg-primary rounded-full">{{ $permission->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" wire:click="closeShowModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-red-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
                </button>
            </div>
		</div>
	</div>
</div>
