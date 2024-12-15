<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bimbingan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Bimbingan</h1>
        <form action="{{ route('bimbingan.update', $bimbingan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_dosen" class="block text-sm font-medium text-gray-700">Nama Dosen</label>
                <input type="text" name="nama_dosen" id="nama_dosen" value="{{ $bimbingan->nama_dosen }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                <input type="text" name="nip" id="nip" value="{{ $bimbingan->nip }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="nama_mahasiswa" class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" value="{{ $bimbingan->nama_mahasiswa }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="npm" class="block text-sm font-medium text-gray-700">NPM</label>
                <input type="text" name="npm" id="npm" value="{{ $bimbingan->npm }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="tanggal_bimbingan" class="block text-sm font-medium text-gray-700">Tanggal Bimbingan</label>
                <input type="date" name="tanggal_bimbingan" id="tanggal_bimbingan" value="{{ $bimbingan->tanggal_bimbingan }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="topik_pembahasan" class="block text-sm font-medium text-gray-700">Topik Pembahasan</label>
                <input type="text" name="topik_pembahasan" id="topik_pembahasan" value="{{ $bimbingan->topik_pembahasan }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="uraian_pembahasan" class="block text-sm font-medium text-gray-700">Uraian Pembahasan</label>
                <textarea name="uraian_pembahasan" id="uraian_pembahasan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $bimbingan->uraian_pembahasan }}</textarea>
            </div>

            <div class="mb-4">
                <label for="angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                <input type="text" name="angkatan" id="angkatan" value="{{ $bimbingan->angkatan }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1 font-semibold">Periode Akademik</label>
                <div class="flex space-x-2">
                    <input name="tahun_awal" type="number" class="w-1/2 p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $bimbingan->tahun_awal }}" required />
                    <input name="tahun_akhir" type="number" class="w-1/2 p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $bimbingan->tahun_akhir }}" required />
                    <select name="semester" class="w-full p-2 rounded bg-blue-200 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="ganjil" {{ $bimbingan->semester == 'ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                        <option value="genap" {{ $bimbingan->semester == 'genap' ? 'selected' : '' }}>Semester Genap</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow-md hover:bg-blue-600 transition duration-300">Update Bimbingan</button>
        </form>
    </div>
</body>
</html>
