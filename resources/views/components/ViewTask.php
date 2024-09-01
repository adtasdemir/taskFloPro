<!-- Edit Task Modal  -->
<div id="editTaskModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0" style="width: 70%;">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-lg xl:max-w-3xl xl:p-0 dark:bg-gray-800 dark:border-gray-700"> <!-- Increased width classes -->
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h2 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit Task
                </h2>
                <form id="editTaskForm" class="space-y-4 md:space-y-6">
                    <input type="hidden" name="id" id="task_id" required hidden>

                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task Name</label>
                        <input type="text" name="name" id="taskName-edit" class="bg-gray-700 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required>
                    </div>

                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task Description</label>
                        <textarea name="description" id="taskDescription-edit" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Task description" required></textarea>
                    </div>

                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="taskStatus-edit" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <!-- Status options will be populated via JavaScript -->
                        </select>
                    </div>

                    <div class="modal-footer flex justify-end">
                        <button type="button" class="btn-secondary px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">Close</button>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>

function openEditModal(taskID) {
     $('#taskStatus-edit').empty();
    $.ajax({
        url: '/tasks/statuses',
        method: 'GET',
        success: function(data) {
            if (data.success) {
                data.data.forEach(function(status) {
                    $('#taskStatus-edit').append(`<option value="${status}">${status}</option>`);
                });
            } else {
                showNotification('Failed to load task statuses. Please try again.', false);
            }
        },
        error: function() {
            showNotification('Error occurred while loading task statuses.', false);
        }
    });

    $.ajax({
        url: '/tasks/' + taskID,
        method: 'GET',
        success: function(data) {
            if (data.success) {
                $('#taskName-edit').val(data.data.name);
                $('#taskDescription-edit').val(data.data.description);
                $('#taskStatus-edit').val(data.data.status);
                $('#task_id').val(taskID);
                $('#editTaskModal').removeClass('hidden');
            } else {
                showNotification('Failed to load task details. Please try again.', false);
            }
        },
        error: function() {
            showNotification('Error occurred while loading task details.', false);
        }
    });
    $('#editTaskModal').removeClass('hidden');
}

$('.btn-close, .btn-secondary').on('click', function() {
    $('#editTaskModal').addClass('hidden');
});

$('#editTaskForm').on('submit', function(e) {
        e.preventDefault(); 

        let formData = {
            name: $('#taskName-edit').val(),
            description: $('#taskDescription-edit').val(),
            status: $('#taskStatus-edit').val(),
            _method: 'PUT', 
            _token: $('input[name=_token]').val() 
        };

        let taskId = $('#task_id').val();
        let url = '/tasks/' + taskId;

        $.ajax({
            url: url,
            type: 'PUT', 
            data: formData,
            success: function(response) {
                if (response.success) {
                    showNotification('Task updated successfully!', true);
                    $('#editTaskModal').addClass('hidden');
                    location.reload();
                } else {
                    showNotification('Failed to update task.', false);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                showNotification('An error occurred while updating the task.', false);
            }
        });
    });

</script>