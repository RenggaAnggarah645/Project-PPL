<div class="relative">
    <button id="logoutButton" class="bg-gray-700 text-white rounded-full w-8 h-8 flex items-center justify-center">
        <i class="fas fa-sign-out-alt"></i>
    </button>
    <i class="fas fa-caret-down absolute top-0 right-0 text-white"></i>
</div>

<script>
    document.getElementById('logoutButton').addEventListener('click', function() {
        window.location.href = '/'; 
    });
</script>