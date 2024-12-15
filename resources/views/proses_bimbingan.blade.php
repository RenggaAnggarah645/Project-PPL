<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Bimbingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        input[readonly] {
            pointer-events: none;
            background-color: #e5e7eb;
        }
    </style>
</head>

<body class="bg-blue-100 h-screen">
    <div class="h-full flex flex-col">
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 p-4 flex items-center justify-between shadow-lg">
            <div class="flex items-center">
                <div class="bg-white p-2 rounded-full">
                    <img alt="Logo Universitas Bengkulu" class="w-10 h-10" height="50"
                        src="https://upload.wikimedia.org/wikipedia/id/d/d8/Logo_UNIB.png" width="50" />
                </div>
                <div class="ml-4 text-white">
                    <div class="text-lg font-bold">PEMBIMBINGAN AKADEMIK</div>
                    <div class="text-sm">Fakultas Teknik Universitas Bengkulu</div>
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
        </div>
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-2 text-white text-center font-semibold shadow-md">
            HALAMAN PROSES BIMBINGAN
        </div>
        <div class="flex justify-center items-center flex-1">
            <form id="bimbingan-form" method="POST" action="{{ route('bimbingan.store') }}"
                class="w-full max-w-6xl bg-white p-8 rounded-lg shadow-lg">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm mb-1 font-semibold">Nama Dosen</label>
                            <input name="nama_dosen"
                                class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="text" value="{{ $dosen->name }}" required readonly tabindex="-1" />
                        </div>
                        <div>
                            <label class="block text-sm mb-1 font-semibold">NIP</label>
                            <input name="nip"
                                class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="text" value="{{ $dosen->nip }}" required readonly tabindex="-1" />
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm mb-1 font-semibold">Nama Mahasiswa</label>
                            <input id="nama_mahasiswa" name="nama_mahasiswa"
                                class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="text" readonly />
                        </div>
                        <div>
                            <label class="block text-sm mb-1 font-semibold">NPM</label>
                            <input id="npm" name="npm"
                                class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="text" required />
                        </div>
                        <div>
                            <label class="block text-sm mb-1 font-semibold">Angkatan</label>
                            <input id="angkatan" name="angkatan"
                                class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="text" readonly />
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm mb-1 font-semibold">Tanggal Bimbingan</label>
                            <input id="tanggal_bimbingan" name="tanggal_bimbingan"
                                class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="date" required readonly />
                        </div>
                        <div>
                            <label class="block text-sm mb-1 font-semibold">Periode Akademik</label>
                            <div class="flex space-x-2">
                                <input name="tahun_awal" type="number"
                                    class="w-1/2 p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Tahun Awal" required />
                                <input name="tahun_akhir" type="number"
                                    class="w-1/2 p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Tahun Akhir" required />
                                <select name="semester"
                                    class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="ganjil">Semester Ganjil</option>
                                    <option value="genap">Semester Genap</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm mb-1 font-semibold">Topik Pembahasan</label>
                            <input name="topik_pembahasan"
                                class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="text" required />
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <label class="block text-sm mb-1 font-semibold">Uraian Pembahasan</label>
                        <textarea name="uraian_pembahasan"
                            class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="4" required></textarea>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded w-full hover:bg-blue-700">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("tanggal_bimbingan").value = today;
        }

        document.getElementById('npm').addEventListener('input', function() {
            const npm = this.value;

            if (npm.length >= 8) { // Sesuaikan panjang valid NPM
                fetch(`/api/mahasiswa/${npm}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('nama_mahasiswa').value = data.mahasiswa.nama;
                            document.getElementById('angkatan').value = data.mahasiswa.angkatan;
                        } else {
                            document.getElementById('nama_mahasiswa').value = '';
                            document.getElementById('angkatan').value = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('nama_mahasiswa').value = '';
                document.getElementById('angkatan').value = '';
            }
        });
    </script>
</body>

</html>
