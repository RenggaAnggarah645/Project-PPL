<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 h-screen bg-white shadow-lg rounded-lg overflow-hidden">
        <ul class="space-y-2">
            
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('hasilBimbinganMenu')">
                    <i class="fas fa-file-alt text-blue-600"></i> <!-- Ikon Hasil Bimbingan -->
                    <a href="{{ route('bimbingan.indexMahasiswa') }}" class="ml-2 block px-2 py-1">Lihat Hasil Bimbingan</a>
                </div>
               
            </li>
        </ul>
    </div>
</div>


