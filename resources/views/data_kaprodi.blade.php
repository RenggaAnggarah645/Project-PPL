<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pembimbingan Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script>
        function toggleFormTambah() {
            var formTambah = document.getElementById('form-tambah');
            formTambah.style.display = formTambah.style.display === 'none' ? 'block' : 'none';
        }

        function searchKaprodi() {
            let input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("kaprodiTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }

        function togglePasswordVisibility(element) {
            if (element.textContent === "******") {
                element.textContent = element.dataset.password;
            } else {
                element.textContent = "******";
            }
        }
    </script>
</head>

<body class="bg-blue-100 flex flex-col min-h-screen">
    <header class="bg-blue-800 text-white p-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center">
            <img alt="Universitas Bengkulu Logo" class="mr-4" height="50" src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="50" />
            <div>
                <h1 class="text-2xl font-bold">PEMBIMBINGAN AKADEMIK</h1>
                <p class="text-sm">Fakultas Teknik Universitas Bengkulu</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <button onclick="window.location.href = '/operator';" class="bg-gray-500 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:bg-gray-600 transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </button>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:bg-red-600 transition duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </header>
    <main class="p-6 flex-grow">
        <div class="bg-red-600 text-white text-center py-3 rounded-lg mb-6 shadow-md">
            <h2 class="text-xl font-bold">DATA KAPRODI</h2>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Form Pencarian -->
            <div class="mb-4 flex items-center justify-between">
                <input type="text" id="search" placeholder="Cari Kaprodi..." 
                       class="w-1/3 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                       onkeyup="searchKaprodi()" />
            </div>
            
            @if(session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table id="kaprodiTable" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-800 text-white">
                        <th class="p-3 text-center">Nama Lengkap</th>
                        <th class="p-3 text-center">NIP</th>
                        <th class="p-3 text-center">Email</th>
                        <th class="p-3 text-center">Password</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_kaprodi as $item)
                        <tr class="border-b hover:bg-gray-100 transition duration-300">
                            <td class="p-3 text-center">{{ $item->nama_lengkap }}</td>
                            <td class="p-3 text-center">{{ $item->nip }}</td>
                            <td class="p-3 text-center">{{ $item->email }}</td>
                            <td class="p-3">
                                <span class="password-display cursor-pointer" data-password="{{ $item->password }}" onclick="togglePasswordVisibility(this)">
                                    ******
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <span class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input {{ $item->status ? 'checked' : '' }} class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" id="toggle{{ $item->id }}" type="checkbox" disabled />
                                    <label class="toggle-label block overflow-hidden h-6 rounded-full {{ $item->status ? 'bg-green-500' : 'bg-red-500' }}" for="toggle{{ $item->id }}"></label>
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <form action="{{ route('data_kaprodi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Hapus</button>
                                </form>
                                <form action="{{ route('data_kaprodi.edit', $item->id) }}" method="GET" style="display:inline;">
                                    <button class="bg-blue-500 text-white px-2 py-1 rounded-lg">Update</button>
                                </form>
                                <form action="{{ route('data_kaprodi.toggleStatus', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg">{{ $item->status ? 'Set Tidak Aktif' : 'Set Aktif' }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6 text-center">
                <button onclick="toggleFormTambah()" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Tambah Data Kaprodi</button>
            </div>
            <!-- Form Tambah Data (Tersembunyi Secara Default) -->
            <div id="form-tambah" style="display: none;" class="mt-6">
                <h3 class="text-lg font-bold mb-2">Tambah Data Kaprodi Baru</h3>
                <form action="{{ route('data_kaprodi.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="nama_lengkap" class="border rounded p-2" placeholder="Nama Lengkap" required />
                        <input type="text" name="nip" class="border rounded p-2" placeholder="NIP" required />
                        <input type="email" name="email" class="border rounded p-2" placeholder="Email" required />
                        <input type="password" name="password" class="border rounded p-2" placeholder="Password" required />
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg mt-4">Simpan</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-blue-800 text-white p-4 text-center">
        <p>&copy; 2024 Universitas Bengkulu. All Rights Reserved.</p>
    </footer>
</body>

</html>
