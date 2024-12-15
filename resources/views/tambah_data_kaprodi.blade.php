<div class="mt-6">
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