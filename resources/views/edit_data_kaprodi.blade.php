<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Edit Data Kaprodi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-100 flex flex-col min-h-screen">
    <main class="p-6 flex-grow">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold mb-4">Edit Kaprodi</h3>
            <form action="{{ route('data_kaprodi.update', $data_kaprodi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="nama_lengkap" value="{{ $data_kaprodi->nama_lengkap }}" required
                    class="border p-2 rounded mb-2" />
                <input type="text" name="nip" value="{{ $data_kaprodi->nip }}" required
                    class="border p-2 rounded mb-2" />
                <input type="email" name="email" value="{{ $data_kaprodi->email }}" required
                    class="border p-2 rounded mb-2" />
                <input type="password" name="password" placeholder="Password" class="border p-2 rounded mb-4" />
                <button type="submit" class="bg-green-500 text-white px-5 py-2 rounded-lg">Update</button>
            </form>
        </div>
    </main>
</body>

</html>
