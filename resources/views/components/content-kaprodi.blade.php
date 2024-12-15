<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div
        class="bg-gradient-to-r from-blue-50 via-blue-100 to-white p-6 rounded-lg shadow-xl flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center mb-4 md:mb-0">
            <img alt="Mascot with graduation cap and laptop"
                class="h-24 w-24 mr-4 rounded-full shadow-lg border-4 border-blue-300" height="100"
                src="https://storage.googleapis.com/a1aa/image/m7KQZPbCqgKTClQm8RLkQxtnFWLiejj9eeGGzeBGPvpAv2fdC.jpg"
                width="100" />
            <div>
                <p class="text-2xl font-semibold text-gray-800">
                    Selamat Datang,
                    <span class="font-extrabold text-blue-600">
                        {{ $kaprodi->name }}
                    </span>
                </p>
                <p class="text-gray-600 mt-2">
                    Saat ini Anda berada di Halaman Kaprodi
                </p>
                <p class="text-gray-500 mt-2">
                    Peran Anda sangat penting untuk melakukan proses berjalannya suatu program yang ada di fakultas
                    teknik ini.
                </p>
            </div>
        </div>
    </div>
    <div class="mt-6 p-6 bg-white rounded-lg shadow-xl">
        <h3 class="text-3xl font-semibold mb-4 text-gray-800">
            Tentang Kaprodi
        </h3>
        <p class="text-gray-700 mb-4">
            Program Studi yang Anda pimpin memiliki visi untuk menjadi pusat pendidikan yang unggul di bidang [Bidang
            Ilmu]. Kami berkomitmen untuk menyediakan pembelajaran yang berkualitas dan relevan dengan perkembangan
            dunia industri.
        </p>
        <h4 class="text-2xl font-semibold mb-2 text-gray-800">
            Visi
        </h4>
        <p class="text-gray-700 mb-4">
            Menjadi program studi terkemuka dalam bidang [Bidang Ilmu] yang mampu menghasilkan lulusan berkualitas,
            kompetitif, dan berdaya saing global.
        </p>
        <h4 class="text-2xl font-semibold mb-2 text-gray-800">
            Misi
        </h4>
        <ul class="list-disc pl-6 text-gray-700 mb-4">
            <li>
                Menyediakan pendidikan yang inovatif dan berkualitas tinggi.
            </li>
            <li>
                Mengembangkan penelitian yang bermanfaat bagi masyarakat dan industri.
            </li>
            <li>
                Memperkuat kerjasama dengan berbagai pihak dalam dan luar negeri.
            </li>
        </ul>
        <h4 class="text-2xl font-semibold mb-2 text-gray-800">
            Tujuan
        </h4>
        <p class="text-gray-700 mb-4">
            Mencetak lulusan yang memiliki keterampilan profesional dan soft skill yang dapat diandalkan dalam
            menghadapi tantangan global.
        </p>
        <h4 class="text-2xl font-semibold mb-2 text-gray-800">
            Kontak
        </h4>
        <p class="text-gray-700">
            Untuk informasi lebih lanjut, silakan hubungi kami di:
        </p>
    </div>
</body>

</html>
