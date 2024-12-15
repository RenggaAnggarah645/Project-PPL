<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .button {
            transition: all 0.3s ease-in-out;
        }

        .button:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="bg-blue-900 text-white p-4 flex justify-between items-center">
        <div class="text-lg font-semibold">Halaman CRUD Mahasiswa</div>
        <div class="flex space-x-4">
            <button id="backButton"
                class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md shadow-md transition">Back</button>
            <button id="logoutButton"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md shadow-md transition">Logout</button>
        </div>
    </div>

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex justify-end space-x-4 mb-2">
            <button id="tambahAkunButton"
                class="bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-00 hover:to-blue-500 text-white font-medium py-3 px-4 rounded-md shadow-md text-sm button">
                Tambah Akun
            </button>
        </div>

        <div class="flex justify-end space-x-4 mb-2">
            <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data"
                class="flex items-center space-x-2">
                @csrf
                <input type="file" name="file" required class="bg-white px-3 py-1 rounded-md shadow-sm">
                <button type="submit"
                    class="bg-gradient-to-r from-green-400 to-teal-500 hover:from-green-500 hover:to-teal-600 text-white py-2 px-4 rounded-md shadow-md button">
                    Import Excel
                </button>
            </form>
        </div>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Akun Mahasiswa</h2>
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Cari Nama Mahasiswa..."
                class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <table class="min-w-full bg-white border rounded-md shadow-md overflow-hidden">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="border px-3 py-2 text-left">Nama Lengkap</th>
                    <th class="border px-3 py-2 text-left">NPM</th>
                    <th class="border px-3 py-2 text-left">Angkatan</th>
                    <th class="border px-3 py-2 text-left">Email</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="mahasiswaTableBody">
                @foreach ($mahasiswa as $m)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="border px-3 py-2">{{ $m->nama }}</td>
                        <td class="border px-3 py-2">{{ $m->npm }}</td>
                        <td class="border px-3 py-2">{{ $m->angkatan }}</td>
                        <td class="border px-3 py-2">{{ $m->email }}</td>
                        <td class="border px-3 py-2 text-center">
                            <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded-md shadow-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="pagination" class="flex justify-center items-center mt-4 space-x-2">
            <button id="prevButton" class="bg-blue-500 text-white py-2 px-4 rounded-md disabled:opacity-50"
                disabled>
                <i class="fas fa-chevron-left"></i> Previous
            </button>
            <div id="pageNumbers" class="flex space-x-2">
                <!-- Page numbers will be dynamically added here -->
            </div>
            <button id="nextButton" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                Next <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <form id="tambahAkunForm" action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-4 mt-6 hidden">
            @csrf
            <div>
                <label for="nama" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" required
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="npm" class="block text-gray-700 font-medium mb-1">NPM</label>
                <input type="text" name="npm" id="npm" required
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="angkatan" class="block text-gray-700 font-medium mb-1">Angkatan</label>
                <input type="text" name="angkatan" id="angkatan" required
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Konfirmasi
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-medium py-2 px-4 rounded-md shadow-md transition duration-200">Tambah</button>
        </form>
    </div>

    <script>
        let currentPage = 1;
        const itemsPerPage = 10;

        function updateTable() {
            const rows = document.querySelectorAll('#mahasiswaTableBody tr');
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            rows.forEach((row, index) => {
                if (index >= start && index < end) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Update button visibility
            document.getElementById('prevButton').disabled = currentPage === 1;
            document.getElementById('nextButton').disabled = end >= rows.length;

            // Update page numbers
            const pageNumbers = document.getElementById('pageNumbers');
            pageNumbers.innerHTML = '';
            const totalPages = Math.ceil(rows.length / itemsPerPage);
            const maxVisiblePages = 5;

            if (totalPages <= maxVisiblePages) {
                for (let i = 1; i <= totalPages; i++) {
                    addPageNumberButton(i);
                }
            } else {
                if (currentPage <= maxVisiblePages - 2) {
                    for (let i = 1; i <= maxVisiblePages - 1; i++) {
                        addPageNumberButton(i);
                    }
                    addEllipsis();
                    addPageNumberButton(totalPages);
                } else if (currentPage > totalPages - (maxVisiblePages - 2)) {
                    addPageNumberButton(1);
                    addEllipsis();
                    for (let i = totalPages - (maxVisiblePages - 2); i <= totalPages; i++) {
                        addPageNumberButton(i);
                    }
                } else {
                    addPageNumberButton(1);
                    addEllipsis();
                    for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                        addPageNumberButton(i);
                    }
                    addEllipsis();
                    addPageNumberButton(totalPages);
                }
            }
        }

        function addPageNumberButton(page) {
            const pageNumber = document.createElement('button');
            pageNumber.textContent = page;
            pageNumber.classList.add('px-3', 'py-1', 'rounded-md', 'shadow-md', 'transition', 'duration-200', 'button');
            if (page === currentPage) {
                pageNumber.classList.add('bg-blue-500', 'text-white');
            } else {
                pageNumber.classList.add('bg-blue-200', 'text-blue-700');
            }
            pageNumber.addEventListener('click', () => {
                currentPage = page;
                updateTable();
            });
            document.getElementById('pageNumbers').appendChild(pageNumber);
        }

        function addEllipsis() {
            const ellipsis = document.createElement('span');
            ellipsis.textContent = '...';
            ellipsis.classList.add('px-3', 'py-1', 'rounded-md', 'shadow-md', 'transition', 'duration-200', 'button', 'bg-blue-200', 'text-blue-700');
            document.getElementById('pageNumbers').appendChild(ellipsis);
        }

        document.getElementById('prevButton').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                updateTable();
            }
        });

        document.getElementById('nextButton').addEventListener('click', () => {
            currentPage++;
            updateTable();
        });

        updateTable();

        document.getElementById('searchInput').addEventListener('input', function (event) {
            const query = event.target.value.toLowerCase();
            const rows = document.querySelectorAll('#mahasiswaTableBody tr');

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

        document.getElementById('backButton').addEventListener('click', function () {
            window.history.back();
        });

        document.getElementById('logoutButton').addEventListener('click', function () {
            window.location.href = '/';
        });

        document.getElementById('tambahAkunButton').addEventListener('click', function () {
            const form = document.getElementById('tambahAkunForm');
            form.classList.toggle('hidden');
        });
    </script>
</body>

</html>