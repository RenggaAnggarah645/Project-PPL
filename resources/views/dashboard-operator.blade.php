<!-- resources/views/dashboar-operator.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembimbingan Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .hover\:bg-gradient-to-r:hover {
            background-image: linear-gradient(to right, #4f46e5, #3b82f6);
        }
    </style>
    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-gray-100">

    @include('components.header')
    <!-- Include Navbar -->
    @include('components.navbar')
    <!-- Main Content -->
    @include('components.content')
    </div>
</body>

</html>
