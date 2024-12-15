<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="bg-blue-900 text-white p-4 flex justify-between items-center">
        <div class="text-lg font-bold">Halaman CRUD Kaprodi</div>
        <div class="flex space-x-4">
            <button id="backButton"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">Back</button>
            <button id="logoutButton"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">Logout</button>
        </div>
    </div>

    <div class="container mx-auto p-8 bg-white rounded-lg shadow-lg mt-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-4 flex justify-between items-center space-x-4">
            <input type="text" id="search" placeholder="Cari Kaprodi..." 
                class="w-1/3 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button id="tambahButton"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow ml-auto">Tambah Kaprodi</button>
        </div>

        <!-- Form tambah data kaprodi -->
        <div id="formTambah" class="hidden space-y-6">
            <form action="{{ route('kaprodi.store') }}" method="POST">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="nip" class="block text-gray-700 font-bold mb-2">NIP</label>
                    <input type="text" name="nip" id="nip" required
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300">Tambah</button>
            </form>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Daftar Akun Kaprodi</h2>
        <table class="min-w-full bg-white border rounded-lg overflow-hidden shadow-lg">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="border px-4 py-2">Nama Lengkap</th>
                    <th class="border px-4 py-2">NIP</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kaprodi as $k)
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <td class="border px-4 py-2">{{ $k->name }}</td>
                        <td class="border px-4 py-2">{{ $k->nip }}</td>
                        <td class="border px-4 py-2">{{ $k->email }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('kaprodi.destroy', $k->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded shadow transition duration-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });

        document.getElementById('logoutButton').addEventListener('click', function() {
            window.location.href = '/';
        });

        // Toggle formTambah visibility
        document.getElementById('tambahButton').addEventListener('click', function() {
            document.getElementById('formTambah').classList.toggle('hidden');
        });

        // Search functionality
        document.getElementById('search').addEventListener('input', function(event) {
            const searchQuery = event.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const nameCell = row.querySelector('td:nth-child(1)');
                const nipCell = row.querySelector('td:nth-child(2)');
                if (nameCell && nipCell) {
                    const nameText = nameCell.textContent.toLowerCase();
                    const nipText = nipCell.textContent.toLowerCase();
                    row.style.display = (nameText.includes(searchQuery) || nipText.includes(searchQuery)) ? '' : 'none';
                }
            });
        });
    </script>
</body>

</html>
