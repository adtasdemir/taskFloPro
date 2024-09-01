<!-- Modal HTML -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-lg font-semibold mb-4 text-white">Confirm Deletion</h2>
        <p class="mb-4 text-white">Are you sure you want to delete this {{substr($message, 0, -1)}}?</p>
        <div class="flex justify-end">
            <button id="cancelBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">Cancel</button>
            <button id="confirmBtn" class="ml-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600">Delete</button>
        </div>
    </div>
</div>


<script>

    const type = @json($message);
    
    let MaindeleteId = null;

    function openDeleteModal(deleteId) {
        MaindeleteId = deleteId;
        $('#deleteModal').removeClass('hidden');
    }

    $('.btn-close, .btn-secondary').on('click', function() {
        $('#editProjectModal').addClass('hidden');
    });

    function closeDeleteModal() {
        $('#deleteModal').addClass('hidden');
    }

    $('#cancelBtn').on('click', closeDeleteModal);

    $('#confirmBtn').on('click', function() {
        if (MaindeleteId) {
            $.ajax({
                url: '/'+type.toLowerCase()+'/'+MaindeleteId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    showNotification(type.slice(0, -1)+' deleted successfully!', true);
                    $('#'+type.toLowerCase().slice(0, -1)+'_'+MaindeleteId).remove();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred while deleting the '+type.slice(0, -1)+'.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    showNotification(errorMessage, false);
                },
                complete: closeDeleteModal
            });
        }
    });
</script>
