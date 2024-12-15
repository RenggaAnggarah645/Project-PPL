<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="bg-blue-900 text-white p-4 flex justify-between items-center">
        <div class="text-lg font-bold">Halaman CRUD Dosen</div>
        <div class="flex space-x-4">
            <button id="backButton" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">Back</button>
            <button id="logoutButton" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">Logout</button>
        </div>
    </div>

    <div class="container mx-auto p-8 bg-white rounded-lg shadow-lg mt-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex justify-end items-center mb-6 space-x-4">
            <button id="addButton" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md h-10">Tambah Akun</button>
        </div>

        <div class="flex justify-end items-center mb-6 space-x-4">
            <form action="{{ route('dosen.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-4">
                @csrf
                <input type="file" name="file" required class="bg-white px-4 py-2 rounded-lg shadow-md h-10">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md h-10">Import Excel</button>
            </form>
        </div>

        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Cari Nama Dosen..." class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Akun Dosen</h2>
        <table class="min-w-full bg-white border rounded-lg overflow-hidden shadow-lg">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="border px-4 py-2">Nama Lengkap</th>
                    <th class="border px-4 py-2">NIP</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody id="dosenTableBody">
                @foreach ($dosen as $d)
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <td class="border px-4 py-2">{{ $d->name }}</td>
                        <td class="border px-4 py-2">{{ $d->nip }}</td>
                        <td class="border px-4 py-2">{{ $d->email }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('dosen.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded shadow transition duration-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="mt-4 flex justify-center items-center space-x-2">
            <button id="prevBtn" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md flex items-center space-x-2">
                <i class="fas fa-chevron-left"></i>
                <span>Previous</span>
            </button>
            <div id="paginationNumbers" class="flex space-x-2"></div>
            <button id="nextBtn" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md flex items-center space-x-2">
                <span>Next</span>
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        
        <form id="addForm" action="{{ route('dosen.store') }}" method="POST" class="space-y-6 hidden mt-8">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="nip" class="block text-gray-700 font-bold mb-2">NIP</label>
                <input type="text" name="nip" id="nip" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300">Tambah</button>
        </form>
    </div>

    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });

        document.getElementById('logoutButton').addEventListener('click', function() {
            window.location.href = '/';
        });

        document.getElementById('addButton').addEventListener('click', function() {
            document.getElementById('addForm').classList.toggle('hidden');
        });

        // Fungsi untuk mencari nama dosen
        document.getElementById('searchInput').addEventListener('input', function(event) {
            const query = event.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const nameCell = row.querySelector('td:nth-child(1)');
                const nameText = nameCell.textContent.toLowerCase();
                if (nameText.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Pagination Logic
        let currentPage = 1;
        const rowsPerPage = 10;
        const rows = document.querySelectorAll('tbody tr');
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        function paginate() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = currentPage * rowsPerPage;
            
            rows.forEach((row, index) => {
                if (index >= start && index < end) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            updatePaginationNumbers();
        }

        function updatePaginationNumbers() {
            const paginationNumbers = document.getElementById('paginationNumbers');
            paginationNumbers.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    const pageNumber = document.createElement('button');
                    pageNumber.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded-lg', 'shadow-md', 'transition', 'duration-300', 'hover:bg-blue-600');
                    pageNumber.textContent = i;
                    pageNumber.addEventListener('click', function() {
                        currentPage = i;
                        paginate();
                    });
                    paginationNumbers.appendChild(pageNumber);
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.classList.add('px-4', 'py-2');
                    ellipsis.textContent = '...';
                    paginationNumbers.appendChild(ellipsis);
                }
            }
        }

        document.getElementById('nextBtn').addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                paginate();
            }
        });

        document.getElementById('prevBtn').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                paginate();
            }
        });

        // Initialize pagination
        paginate();
    </script>
</body>
</html>