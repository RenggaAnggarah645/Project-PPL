<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 h-screen bg-white shadow-lg rounded-lg overflow-hidden">
        <ul class="space-y-2">
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('akunMenu')">
                    <i class="fas fa-user-cog text-blue-600"></i>
                    <span class="ml-2 font-semibold">Manajemen Akun</span>
                    <i class="fas fa-chevron-down ml-auto"></i>
                </div>
                <ul class="pl-8 space-y-2 text-gray-600 hidden" id="akunMenu">
                    <li class="flex items-center hover:text-blue-600 transition duration-300 cursor-pointer">
                        <i class="fas fa-user-tie"></i>
                        <a href="{{ route('kaprodi.index') }}" class="ml-2 block px-2 py-1">Kaprodi</a>
                    </li>
                    <li class="flex items-center hover:text-blue-600 transition duration-300 cursor-pointer">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <a href="{{ route('dosen.index') }}" class="ml-2 block px-2 py-1">Dosen PA</a>
                    </li>
                    <li class="flex items-center hover:text-blue-600 transition duration-300 cursor-pointer">
                        <i class="fas fa-user-graduate"></i>
                        <a href="{{ route('mahasiswa.index') }}" class="ml-2 block px-2 py-1">Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('kaprodiMenu')">
                    <i class="fas fa-cogs text-green-600"></i>
                    <a href="{{ route('data_kaprodi.index') }}" class="ml-2 font-semibold"">Manajemen Kaprodi</a>
                </div>
            </li>
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('dosenMenu')">
                    <i class="fas fa-user-friends text-purple-600"></i>
                    <a href="{{ route('data_dosen.index') }}" class="ml-2 font-semibold"">Manajemen Dosen PA</a>
                </div>
            </li>
            <li>
                <div class="flex items-center p-4 text-gray-700 hover:bg-gray-50 transition duration-300 cursor-pointer"
                    onclick="toggleMenu('mahasiswaMenu')">
                    <i class="fas fa-user-graduate"></i>
                    <a href="{{ route('data_mahasiswa.index') }}" class="ml-2 font-semibold"">Manajemen Mahasiswa</a>
                </div>
            </li>
        </ul>
    </div>
