<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-blue-100 flex flex-col min-h-screen">
    <header class="bg-blue-800 text-white p-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center">
            <img alt="Logo" class="mr-4" height="50"
                src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="50" />
            <div>
                <h1 class="text-2xl font-bold">DATA MAHASISWA</h1>
                <p class="text-sm">Fakultas Teknik Universitas Bengkulu</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <button onclick="window.location.href = '/operator';"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:bg-gray-600 transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </button>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button
                    class="bg-red-500 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:bg-red-600 transition duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <main class="p-6 flex-grow">
        <div class="bg-red-600 text-white text-center py-3 rounded-lg mb-6 shadow-md">
            <h2 class="text-xl font-bold">DATA MAHASISWA</h2>
        </div>

        <main class="container mx-auto p-6 flex-grow">
            <div class="flex justify-end mb-4">
                <button onclick="toggleFormTambah()" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Mahasiswa
                </button>
            </div>

            <div id="form-tambah" class="bg-white p-6 rounded-lg shadow-lg mb-6 hidden">
                <h3 class="text-xl font-semibold mb-4">Tambah Mahasiswa Baru</h3>
                <form action="{{ route('data_mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required class="border rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <input type="text" name="npm" placeholder="NPM" required class="border rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <input type="text" name="angkatan" placeholder="Angkatan" required class="border rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <input type="email" name="email" placeholder="Email" required class="border rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <input type="password" name="password" placeholder="Password" required class="border rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 w-full">Simpan</button>
                    </div>
                </form>
                 <!-- Form Upload Excel -->
            <div class="mt-6">
                <form action="{{ route('data_mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required accept=".xls,.xlsx" class="border rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" />
                    <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-700 transition duration-300 w-full">Impor Data dari Excel</button>
                </form>
            </div>
        </div>
            </div>

            <div class="mb-4">
                <input type="text" id="search" placeholder="Cari Mahasiswa..."
                    class="w-1/3 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onkeyup="searchTable()">
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <table id="mahasiswaTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-800 text-white">
                            <th class="p-3 text-left">Nama Lengkap</th>
                            <th class="p-3 text-center">NPM</th>
                            <th class="p-3 text-center">Angkatan</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Password</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        @foreach ($data_mahasiswa as $item)
                            <tr class="border-b hover:bg-gray-100 transition duration-300">
                                <td class="p-3 text-left">{{ $item->nama_lengkap }}</td>
                                <td class="p-3 text-center">{{ $item->npm }}</td>
                                <td class="p-3 text-center">{{ $item->angkatan }}</td>
                                <td class="p-3 text-left">{{ $item->email }}</td>
                                <td class="p-3">
                                    <span class="password-display cursor-pointer" data-password="{{ $item->password }}" onclick="togglePasswordVisibility(this)">
                                        ******
                                    </span>
                                </td>
                                
                                <td class="p-3 text-center">
                                    <span
                                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                        <input {{ $item->status ? 'checked' : '' }}
                                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                            id="toggle{{ $item->id }}" type="checkbox" disabled />
                                        <label
                                            class="toggle-label block overflow-hidden h-6 rounded-full {{ $item->status ? 'bg-green-500' : 'bg-red-500' }}"
                                            for="toggle{{ $item->id }}"></label>
                                    </span>
                                </td>
                                <td class="p-3 text-center">
                                    <form action="{{ route('data_mahasiswa.edit', $item->id) }}" method="GET"
                                        style="display:inline;">
                                        <button class="bg-blue-500 text-white px-2 py-1 rounded-lg">Edit</button>
                                    </form>
                                    <form action="{{ route('data_mahasiswa.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Hapus</button>
                                    </form>
                                    <form action="{{ route('data_mahasiswa.toggleStatus', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button
                                            class="bg-yellow-500 text-white px-2 py-1 rounded-lg">{{ $item->status ? 'Set Tidak Aktif' : 'Set Aktif' }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="pagination" class="mt-6 text-center space-x-2"></div>
        </main>
    </main>

    <script>
        let currentPage = 1;
        const rowsPerPage = 10;
        let rows = [];

        function toggleFormTambah() {
            var formTambah = document.getElementById('form-tambah');
            formTambah.style.display = formTambah.style.display === 'none' ? 'block' : 'none';
        }

        function searchTable() {
            let input = document.getElementById("search").value.toLowerCase();
            let filteredRows = rows.filter(row => {
                const cells = Array.from(row.getElementsByTagName("td"));
                return cells.some(cell => cell.textContent.toLowerCase().includes(input));
            });
            displayRows(filteredRows);
        }

        function sortNames() {
            rows.sort((rowA, rowB) => {
                let nameA = rowA.cells[0].textContent.toLowerCase();
                let nameB = rowB.cells[0].textContent.toLowerCase();
                return nameA.localeCompare(nameB);
            });
            displayRows(rows);
        }

        function paginateRows() {
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = currentPage * rowsPerPage;
            const rowsToDisplay = rows.slice(startIndex, endIndex);
            displayRows(rowsToDisplay);
        }

        function displayRows(rowsToDisplay) {
            const tableBody = document.getElementById("dataTable");
            tableBody.innerHTML = "";
            rowsToDisplay.forEach(row => tableBody.appendChild(row));
            updatePagination();
        }

        function updatePagination() {
            const totalPages = Math.ceil(rows.length / rowsPerPage);
            let paginationHtml = "";
            if (currentPage > 1) {
                
                paginationHtml += `<button class="px-4 py-2 bg-blue-600 text-white rounded-lg" onclick="changePage(currentPage - 1)">Previous</button>`;
            }

            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, currentPage + 2);
            if (startPage > 1) paginationHtml += "<span class='px-4 py-2'>...</span>";
            for (let i = startPage; i <= endPage; i++) {
                paginationHtml += `<button class="px-4 py-2 ${i === currentPage ? 'bg-blue-600 text-white' : 'bg-gray-200'} rounded-lg" onclick="changePage(${i})">${i}</button>`;
            }
            if (endPage < totalPages) paginationHtml += "<span class='px-4 py-2'>...</span>";

            if (currentPage < totalPages) {
                paginationHtml += `<button class="px-4 py-2 bg-blue-600 text-white rounded-lg" onclick="changePage(currentPage + 1)">Next</button>`;
                
            }
            document.getElementById("pagination").innerHTML = paginationHtml;
        }

        function changePage(pageNumber) {
            currentPage = pageNumber;
            paginateRows();
        }

        document.addEventListener("DOMContentLoaded", () => {
            rows = Array.from(document.querySelectorAll("#mahasiswaTable tbody tr"));
            paginateRows();
        });

        function togglePasswordVisibility(element) {
        if (element.textContent === "******") {
            // Menampilkan password asli
            element.textContent = element.dataset.password;
        } else {
            // Menyembunyikan password kembali
            element.textContent = "******";
        }
    }
    </script>
</body>

</html>
