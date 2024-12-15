<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Hasil Bimbingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memastikan bahwa Font Awesome dimuat dengan benar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        let timeout;

        function searchBimbingan() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const searchTerm = document.getElementById('searchTerm').value.toLowerCase();
                const rows = document.querySelectorAll('.bimbingan-row');

                rows.forEach(row => {
                    const namaDosen = row.querySelector('.nama-dosen').textContent.toLowerCase();
                    const nip = row.querySelector('.nip').textContent.toLowerCase();
                    const periode = row.querySelector('.periode').textContent.toLowerCase();

                    if (namaDosen.includes(searchTerm) || nip.includes(searchTerm) || periode.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }, 300); // Debounce delay of 300ms
        }
    </script>
</head>
<body class="bg-blue-100 h-screen">
<div class="h-full flex flex-col">
    <div class="bg-gradient-to-r from-blue-800 to-blue-600 p-4 flex items-center justify-between shadow-lg relative">
        <div class="flex items-center">
            <div class="bg-white p-2 rounded-full">
                <img alt="Logo" class="w-10 h-10" height="50" src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="50"/>
            </div>
            
            <div class="ml-4 text-white">
                <div class="text-lg font-bold">PEMBIMBINGAN AKADEMIK</div>
                <div class="text-sm">Fakultas Teknik Universitas Bengkulu</div>
            </div>
        </div>

        <!-- Tombol di kanan atas -->
        <div class="absolute top-4 right-4 flex space-x-4">
            <button
                    onclick="window.location.href = '/-mahasiswa';" class="bg-gray-500 text-white px-4 py-2 rounded flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i> <!-- Pastikan menggunakan kelas Font Awesome yang benar -->
                    <span>Back</span>
                </button>
            
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button
                        class="bg-red-500 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:bg-red-600 transition duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
        </div>
    </div>
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-2 text-white text-center font-semibold shadow-md">
        HASIL BIMBINGAN MAHASISWA
    </div>
    
    <!-- Input Pencarian dengan Tombol -->
    <div class="p-6 bg-white flex items-center space-x-4">
        <input
            type="text"
            id="searchTerm"
            class="px-4 py-2 border border-gray-300 rounded-md"
            placeholder="Cari berdasarkan Nama Dosen, NIP, atau Periode"
            oninput="searchBimbingan()"
        />
        <button
            onclick="searchBimbingan()"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300"
        >
            <i class="fas fa-search"></i> Cari
        </button>
    </div>

    <div class="p-6 flex flex-col overflow-y-auto bg-white">
        @foreach ($bimbingans->groupBy(function($item) { return $item->tahun_awal . ' - ' . $item->tahun_akhir . ' ' . ucfirst($item->semester); }) as $periode => $bimbingan_group)
            <div class="mb-6">
                <!-- Tabel untuk setiap periode -->
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <!-- Baris untuk Periode Akademik -->
                        <tr class="bg-blue-200">
                            <th colspan="3" class="py-2 px-4 text-left text-lg font-semibold text-blue-600">
                                Periode: {{ $periode }}
                            </th>
                        </tr>
                        <tr class="bg-blue-100">
                            <th class="px-4 py-2 text-left text-gray-700">Nama Dosen</th>
                            <th class="px-4 py-2 text-left text-gray-700">NIP</th>
                            <th class="px-4 py-2 text-left text-gray-700">Periode Akademik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bimbingan_group->unique('nama_dosen') as $bimbingan)
                            <tr class="border-b bimbingan-row">
                                <td class="py-2 px-4 nama-dosen">
                                    <a href="{{ route('bimbingan.dosenMahasiswa', $bimbingan->nama_dosen) }}?tahun_awal={{ $bimbingan->tahun_awal }}&tahun_akhir={{ $bimbingan->tahun_akhir }}&semester={{ $bimbingan->semester }}" class="text-blue-600 hover:underline">
                                        {{ $bimbingan->nama_dosen }}
                                    </a>
                                  
                                </td>
                                <td class="py-2 px-4 nip">
                                    {{ $bimbingan->nip }}
                                </td>
                                <td class="py-2 px-4 periode">
                                    {{ $bimbingan->tahun_awal }} / {{ $bimbingan->tahun_akhir }} - {{ ucfirst($bimbingan->semester) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
