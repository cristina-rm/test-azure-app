<!-- Confirm delete Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
	<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
		<div class="fixed inset-0 transition-opacity" aria-hidden="true">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>

		<!-- This element is to trick the browser into centering the modal contents. -->
		<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

		<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full" role="dialog" aria-modal="true" aria-labelledby="modal-confirmDelete">
            <div class="bg-gray-50 px-4 py-6 sm:px-8 sm:flex sm:flex-row-reverse">
                <div class="w-full">
                    <h3 class="text-3xl font-normal text-primary" id="modal-confirmDelete">
                        Confirm delete
                    </h3>
                </div>
            </div>

            <div class="bg-white p-6 sm:py-10 sm:px-10">
                <div class="flex mb-6">
                    <p class="font-semibold text-lg text-gray-700">Are you sure want to delete this?</p>
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" wire:click="delete()" onclick="showBodyScroll(true)" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-200 sm:ml-3 sm:w-auto sm:text-sm">
                Delete
                </button>

                <button type="button" wire:click="closeConfirmDeleteModal()" onclick="showBodyScroll(true)" class="mt-3 w-full inline-flex justify-center rounded-md border border-red-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-primary hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
                </button>
            </div>
		</div>
	</div>
</div>
