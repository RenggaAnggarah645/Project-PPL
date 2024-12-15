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

        function searchPeriode() {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                const searchTerm = document.getElementById('periodeSearch').value.toLowerCase();
                const groups = document.querySelectorAll('.periode-group');

                groups.forEach(group => {
                    const periodeTitle = group.querySelector('.periode-title').textContent.toLowerCase();
                    if (periodeTitle.includes(searchTerm)) {
                        group.style.display = '';
                    } else {
                        group.style.display = 'none';
                    }
                });
            }, 300); // Menunggu 300ms setelah selesai mengetik
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
                    onclick="window.location.href = '/kaprodi';" class="bg-gray-500 text-white px-4 py-2 rounded flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i> <!-- Pastikan menggunakan kelas Font Awesome yang benar -->
                    <span>Back</span>
                </button>
            
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt"></i> <!-- Pastikan menggunakan kelas Font Awesome yang benar -->
                        <span>Logout</span>
                    </button>
                </form>
        </div>
    </div>
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-2 text-white text-center font-semibold shadow-md">
        HASIL BIMBINGAN
    </div>
    <!-- Input Pencarian Periode Akademik -->
    <div class="p-4">
        <input 
            type="text" 
            id="periodeSearch" 
            class="px-4 py-2 border border-gray-300 rounded-md" 
            placeholder="Cari berdasarkan periode..."
            oninput="searchPeriode()"
        />
    </div>
    <div class="flex-grow bg-white p-4 flex shadow-lg">
        <div class="w-full">
            @foreach ($bimbingans->groupBy(function($item) { return $item->tahun_awal . ' - ' . $item->tahun_akhir . ' ' . ucfirst($item->semester); }) as $periode => $bimbingan_group)
                <div class="mb-6 periode-group">
                    <!-- Baris periode dengan warna -->
                    <table class="w-full table-auto border-collapse mt-2">
                        <thead>
                            <tr class="bg-blue-400">
                                <th colspan="2" class="py-2 px-4 text-left text-lg font-semibold text-blue-800 periode-title">
                                    {{ $periode }}
                                </th>
                            </tr>
                            <tr class="bg-blue-200">
                                <th class="py-2 px-4 text-left">Nama Dosen</th>
                                <th class="py-2 px-4 text-left">NIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bimbingan_group->unique('nama_dosen') as $bimbingan)
                                <tr>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('bimbingan.dosenKaprodi', ['nama_dosen' => $bimbingan->nama_dosen, 'tahun_awal' => $bimbingan->tahun_awal, 'tahun_akhir' => $bimbingan->tahun_akhir, 'semester' => $bimbingan->semester]) }}" class="text-blue-600 hover:underline">{{ $bimbingan->nama_dosen }}</a>

                                    </td>
                                    <td class="py-2 px-4">
                                        {{ $bimbingan->nip }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
