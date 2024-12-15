<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hover\:bg-gradient-to-r:hover {
            background-image: linear-gradient(to right, #4f46e5, #3b82f6);
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <!-- Header -->
    @include('components.header')

    <div class="flex">

        <!-- Sidebar -->
        <div class="w-64 h-screen bg-white shadow-lg rounded-lg overflow-hidden">
            @include('components.nav-mahasiswa')
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4">
            @include('components.content-mahasiswa')
        </div>
    </div>

</body>

</html>
