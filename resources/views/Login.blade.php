<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20210313/pngtree-abstract-black-and-blue-background-image_585724.jpg');
            background-size: 100% 100vh;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-50">
    <div class="bg-white bg-opacity-50 p-5 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-center mb-4">
            <img alt="University Logo" class="w-20 h-20" height="100" src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="100"/>
        </div>
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">
            Sistem Pembimbingan Akademik
        </h2>
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">
            Program Studi Sistem Informasi
        </h2>
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">
            Fakultas Teknik
        </h2>
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">
            Universitas Bengkulu
        </h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="mb-4">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700" for="email">
                    <i class="fas fa-user"></i>
                    Email
                </label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="email" value="{{ old('email') }}" name="email" type="email" placeholder="Email"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700" for="password">
                    <i class="fas fa-lock"></i>
                    Password
                </label>
                <div class="relative">
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="password" name="password" type="password" placeholder="Password"/>
                    <i class="fas fa-eye absolute right-3 top-3 text-gray-500 cursor-pointer"></i>
                </div>
            </div>
            <div class="mb-4">
                <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600" type="submit">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>