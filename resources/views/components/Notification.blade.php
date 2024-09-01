<!-- resources/views/components/notification.blade.php -->
<div id="notification" class="fixed top-0 right-0 mt-4 mr-4 px-4 py-2 rounded shadow-lg hidden">
    <p id="notification-message" class="text-white"></p>
</div>

<script>
    function showNotification(message, isSuccess) {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');

        notificationMessage.textContent = message;
        notification.classList.remove('hidden');
        notification.classList.add(isSuccess ? 'bg-green-500' : 'bg-red-500');

        setTimeout(() => {
            notification.classList.add('hidden');
        }, 2000);
    }
</script>
