<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Hasil Bimbingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function searchPeriode() {
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

        <div class="flex space-x-3">
            <button onclick="window.location.href = '/bimbingan/create';"
                class="bg-gray-500 text-white rounded-lg flex items-center shadow-md hover:bg-gray-600 transition duration-300"
                style="width: 100px; height: 40px; padding: 10px;">
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
            @php
                // Mengelompokkan data berdasarkan periode akademik
                $groupedByPeriode = $bimbingans->groupBy(fn($bimbingan) => 
                    "{$bimbingan->tahun_awal} / {$bimbingan->tahun_akhir} - " . ucfirst($bimbingan->semester)
                );
            @endphp

@foreach ($groupedByPeriode as $periode => $bimbingansInPeriode)
<div class="periode-group mb-6">
    <div class="bg-blue-300 text-white font-bold px-4 py-2 rounded-t-md periode-title">
        {{ $periode }}
    </div>
    <table class="w-full table-auto border-collapse bg-white">
        <thead>
            <tr class="bg-blue-200">
                <th class="py-2 px-4 text-left">Nama Dosen</th>
                <th class="py-2 px-4 text-left">NIP</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Menghilangkan duplikasi nama dosen dan NIP
                $uniqueBimbingans = $bimbingansInPeriode->unique('nama_dosen');
            @endphp
            @foreach ($uniqueBimbingans as $bimbingan)
                <tr>
                    <td class="py-2 px-4">
                        <a href="{{ route('bimbingan.showByDosen', ['nama_dosen' => $bimbingan->nama_dosen, 'tahun_awal' => $bimbingan->tahun_awal, 'tahun_akhir' => $bimbingan->tahun_akhir, 'semester' => $bimbingan->semester]) }}" class="text-blue-600 hover:underline">
                            {{ $bimbingan->nama_dosen }}
                        </a>
                    </td>
                    <td class="py-2 px-4">{{ $bimbingan->nip }}</td>
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
