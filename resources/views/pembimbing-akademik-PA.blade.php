<!DOCTYPE html>
<html>

<head>
    <title>Pembimbing Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<header class="bg-blue-800 text-white p-4 flex items-center justify-between shadow-lg">
    <div class="flex items-center">
        <img alt="Universitas Bengkulu Logo" class="mr-4" height="50"
            src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="50" />
        <div>
            <h1 class="text-2xl font-bold">PEMBIMBINGAN AKADEMIK</h1>
            <p class="text-sm">Fakultas Teknik Universitas Bengkulu</p>
        </div>
    </div>
    <div class="flex space-x-3">
        <button onclick="window.location.href = '/dosen';"
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
</header>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-700">Pembimbing Akademik</h1>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <form action="{{ route('pembimbing-akademik-PA.indexPA') }}" method="GET">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-blue-700 font-bold mb-2">Angkatan</label>
                        <select id="angkatan_select" name="angkatan"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Semua Angkatan --</option>
                            <option value="manual">-- Masukkan Angkatan Manual --</option>
                        </select>
                        <input id="angkatan_manual" type="text" name="angkatan_manual"
                            placeholder="Masukkan Angkatan"
                            class="w-full mt-2 border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 hidden"
                            oninput="filterMahasiswaByAngkatan()">
                    </div>
                    <div>
                        <label class="block text-blue-700 font-bold mb-2">Pembimbing Akademik</label>
                        <select name="dosen_id"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Semua Pembimbing --</option>
                            @foreach ($dosen as $dsn)
                                <option value="{{ $dsn->id }}"
                                    {{ request('dosens_id') == $dsn->id ? 'selected' : '' }}>{{ $dsn->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-2 rounded-lg w-1/4 mt-0">Cari</button>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('pembimbing-akademik.print', ['dosen_id' => request('dosen_id'), 'angkatan' => request('angkatan')]) }}"
                        class="bg-green-500 text-white p-3 rounded-lg hover:bg-green-600">
                        <i class="fas fa-print"></i> Cetak Daftar Pembimbing Akademik
                    </a>
                </div>
            </form>

            <div class="overflow-x-auto">
                <form action="{{ route('pembimbing-akademik.storeMultiple') }}" method="POST">
                    @csrf
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-blue-700 text-white uppercase text-sm leading-normal">
                                <th class="py-3 px-4 text-left">
                                    <input type="checkbox" id="select_all" class="focus:outline-none">
                                </th>
                                <th class="py-3 px-4 text-left">NPM</th>
                                <th class="py-3 px-4 text-left">Nama</th>
                                <th class="py-3 px-4 text-left">Angkatan</th>
                                <th class="py-3 px-4 text-left">Pembimbing Akademik</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @foreach ($mahasiswa as $mhs)
                                <tr class="border-b border-gray-200 hover:bg-gray-100 angkatan_{{ $mhs->angkatan }}">
                                    <td class="py-3 px-4 text-left">
                                        <input type="checkbox" name="mahasiswa_ids[]" value="{{ $mhs->id }}"
                                            class="checkbox_mahasiswa focus:outline-none">
                                    </td>
                                    <td class="py-3 px-4 text-left">{{ $mhs->npm }}</td>
                                    <td class="py-3 px-4 text-left">{{ $mhs->nama_lengkap }}</td>
                                    <td class="py-3 px-4 text-left">{{ $mhs->angkatan }}</td>
                                    <td class="py-3 px-4 text-left">
                                        @if ($mhs->dosen_pembimbing)
                                            {{ $mhs->dosen_pembimbing->name }}
                                        @else
                                            Belum ada pembimbing
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        {{ $mahasiswa->links('pagination::tailwind') }}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('angkatan_select').addEventListener('change', function(e) {
            if (e.target.value === 'manual') {
                document.getElementById('angkatan_manual').classList.remove('hidden');
            } else {
                document.getElementById('angkatan_manual').classList.add('hidden');
                filterMahasiswaByAngkatan();
            }
        });
        function filterMahasiswaByAngkatan() {
            const angkatanInput = document.getElementById('angkatan_manual').value;
            const mahasiswaRows = document.querySelectorAll('tbody tr');
            mahasiswaRows.forEach(function(row) {
                const angkatan = row.classList.contains('angkatan_' + angkatanInput);
                if (angkatanInput && !angkatan) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        }
    </script>
</body>

</html>
