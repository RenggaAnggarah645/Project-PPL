<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Manajemen')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav class="bg-blue-900 text-white p-4">
            @include('components.navbar')
        </nav>
    </header>

    <main class="container mx-auto mt-4">
        @yield('content')
    </main>

    <footer class="text-center mt-4">
        <p>&copy; 2024 Aplikasi Manajemen</p>
    </footer>
</body>
</html>
