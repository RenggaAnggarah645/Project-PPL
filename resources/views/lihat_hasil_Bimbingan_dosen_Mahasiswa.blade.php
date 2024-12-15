<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa yang Dibimbing oleh {{ $nama_dosen }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-blue-100 h-screen">
    <div class="h-full flex flex-col">
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 p-4 flex items-center justify-between shadow-lg relative">
            <div class="flex items-center">
                <div class="bg-white p-2 rounded-full">
                    <img alt="Logo" class="w-10 h-10" height="50" src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="50" />
                </div>
                <div class="ml-4 text-white">
                    <div class="text-lg font-bold">PEMBIMBINGAN AKADEMIK</div>
                    <div class="text-sm">Fakultas Teknik Universitas Bengkulu</div>
                </div>
            </div>

            <div class="absolute top-4 right-4 flex space-x-4">
                <a href="{{ route('bimbingan.indexMahasiswa') }}">
                    <button class="bg-gray-500 text-white px-4 py-2 rounded flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i> 
                        <span>Back</span>
                    </button>
                </a>

                <a href="{{ route('logout') }}">
                    <button class="bg-red-500 text-white px-4 py-2 rounded flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt"></i> 
                        <span>Logout</span>
                    </button>
                </a>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-2 text-white text-center font-semibold shadow-md">
            Mahasiswa yang Dibimbing oleh {{ $nama_dosen }}
        </div>

        <div class="flex-grow bg-white p-4 flex shadow-lg">
            <div class="w-full">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="py-2 px-4 text-left">Nama Mahasiswa</th>
                            <th class="py-2 px-4 text-left">NPM</th>
                            <th class="py-2 px-4 text-left">Angkatan</th>
                            <th class="py-2 px-4 text-left">Tanggal Bimbingan</th>
                            <th class="py-2 px-4 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bimbingans as $bimbingan)
                            <tr>
                                <td class="py-2 px-4">{{ $bimbingan->nama_mahasiswa }}</td>
                                <td class="py-2 px-4">{{ $bimbingan->npm }}</td>
                                <td class="py-2 px-4">{{ $bimbingan->angkatan }}</td>
                                <td class="py-2 px-4">{{ $bimbingan->tanggal_bimbingan }}</td>
                                <td class="py-2 px-4 space-x-2">
                                    <!-- Tombol Lihat Detail -->
                                    <a href="{{ route('bimbingan.show', $bimbingan->id) }}" class="bg-green-600 text-white py-1 px-3 rounded-md hover:bg-green-500 transition-colors duration-200">Lihat Detail</a>

                                    <!-- Tombol Cetak Hasil Bimbingan -->
                                    <a href="{{ route('bimbingan.export', ['id' => $bimbingan->npm, 'tahun_awal' => request()->query('tahun_awal'), 'tahun_akhir' => request()->query('tahun_akhir'), 'semester' => request()->query('semester')]) }}" class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-400 transition-colors duration-200">Cetak Hasil Bimbingan</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
