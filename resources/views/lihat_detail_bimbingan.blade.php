<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Bimbingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 h-screen">
<div class="h-full flex flex-col">
    <div class="bg-gradient-to-r from-blue-800 to-blue-600 p-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center">
            <div class="bg-white p-2 rounded-full">
                <img alt="Logo" class="w-10 h-10" height="50" src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="50"/>
            </div>
            <div class="ml-4 text-white">
                <div class="text-lg font-bold">PEMBIMBINGAN AKADEMIK</div>
                <div class="text-sm">Fakultas Teknik Universitas Bengkulu</div>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-2 text-white text-center font-semibold shadow-md">
        Detail Bimbingan
    </div>
    <div class="flex-grow bg-white p-4 flex shadow-lg">
        <div class="w-full">
            <table class="w-full table-auto border-collapse">
                <tr>
                    <th class="py-2 px-4 text-left">Nama Dosen</th>
                    <td class="py-2 px-4">{{ $bimbingan->nama_dosen }}</td>
                </tr>
                <tr>
                    <th class="py-2 px-4 text-left">NIP</th>
                    <td class="py-2 px-4">{{ $bimbingan->nip }}</td>
                </tr>
                <tr>
                    <th class="py-2 px-4 text-left">Nama Mahasiswa</th>
                    <td class="py-2 px-4">{{ $bimbingan->nama_mahasiswa }}</td>
                </tr>
                <tr>
                    <th class="py-2 px-4 text-left">Tanggal Bimbingan</th>
                    <td class="py-2 px-4">{{ $bimbingan->tanggal_bimbingan }}</td>
                </tr>
                <tr>
                    <th class="py-2 px-4 text-left">Topik Pembahasan</th>
                    <td class="py-2 px-4">{{ $bimbingan->topik_pembahasan }}</td>
                </tr>
                <tr>
                    <th class="py-2 px-4 text-left">Uraian Pembahasan</th>
                    <td class="py-2 px-4">{{ $bimbingan->uraian_pembahasan }}</td>
                </tr>
                <!-- Menambahkan kolom Periode Akademik -->
                <tr>
                    <th class="py-2 px-4 text-left">Periode Akademik</th>
                    <td class="py-2 px-4">
                        {{ $bimbingan->tahun_awal }} / {{ $bimbingan->tahun_akhir }} - 
                        {{ ucfirst($bimbingan->semester) }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
