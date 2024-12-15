<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Edit Data Mahasiswa </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 flex flex-col min-h-screen">
    <header class="bg-blue-800 text-white p-4">
        <h1 class="text-2xl font-bold">Edit Data Mahasiswa </h1>
    </header>
    <main class="p-6 flex-grow">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('data_mahasiswa.update', $data_mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="nama_lengkap" value="{{ $data_mahasiswa->nama_lengkap }}" required class="border rounded px-4 py-2" />
                    <input type="text" name="npm" value="{{ $data_mahasiswa->npm }}" required class="border rounded px-4 py-2" />
                    <input type="text" name="angkatan" value="{{ $data_mahasiswa->angkatan }}" required class="border rounded px-4 py-2" />
                    <input type="email" name="email" value="{{ $data_mahasiswa->email }}" required class="border rounded px-4 py-2" />
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah" class="border rounded px-4 py-2" />
                </div>
                <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Update Mahasiswa</button>
            </form>
        </div>
    </main>
</body>
</html>
