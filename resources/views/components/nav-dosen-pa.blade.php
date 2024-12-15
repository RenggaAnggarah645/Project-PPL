<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 h-screen bg-white shadow-lg rounded-lg overflow-hidden">
        <ul class="space-y-2">
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('bimbinganMenu')">
                    <i class="fas fa-users-cog text-purple-600 mr-2"></i> <!-- Margin kanan untuk ikon -->
                    <span class="font-semibold">Manajemen Proses Bimbingan</span>
                    <i class="fas fa-chevron-down ml-auto"></i>
                </div>
                <ul class="pl-8 space-y-2 text-gray-600 hidden" id="bimbinganMenu">
                    <li class="flex items-center hover:text-purple-600 transition duration-300 cursor-pointer">
                        <i class="fas fa-user-graduate"></i>
                        <a href="{{ route('pembimbing-akademik-PA.indexPA') }}" class="ml-2 block px-2 py-1">Lihat
                            Data</a>
                    </li>
                    <li class="flex items-center hover:text-purple-600 transition duration-300 cursor-pointer">
                        <i class="fas fa-user-graduate"></i>
                        <a href="{{ route('bimbingan.create') }}" class="ml-2 block px-2 py-1">Bimbingan</a>
                    </li>
                </ul>
            </li>

            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('hasilBimbinganMenu')">
                    <i class="fas fa-file-alt text-blue-600 mr-2"></i> <!-- Ikon Hasil Bimbingan dengan margin kanan -->
                    <a href="{{ route('bimbingan.index') }}" class="ml-2 block px-2 py-1">Lihat Hasil Bimbingan</a>
                </div>
            </li>
        </ul>
    </div>
</div>
