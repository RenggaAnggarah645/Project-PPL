<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 h-screen bg-white shadow-lg rounded-lg overflow-hidden">
        <ul class="space-y-2">
            <!-- Manajemen Pembimbing Akademik -->
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer">
                    <a href="{{ route('pembimbing-akademik.index') }}" class="flex items-center w-full">
                        <i class="fas fa-chalkboard-teacher text-purple-600"></i>
                        <span class="ml-2 font-semibold">Manajemen Pembimbing Akademik</span>
                        
                    </a>
                </div>
                
                <!-- Lihat Hasil Bimbingan -->
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('bimbingan.indexKaprodi')">
                    <i class="fas fa-file-alt text-blue-600"></i> <!-- Ikon Hasil Bimbingan -->
                    <a href="{{ route('bimbingan.indexKaprodi') }}" class="ml-2 block px-2 py-1">Lihat Hasil Bimbingan</a>
                    
                </div>
               
            </li>
        </ul>
    </div>
</div>
