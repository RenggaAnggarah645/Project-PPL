<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="font-roboto bg-gray-50">
    <div
        class="bg-gradient-to-r from-blue-50 via-blue-100 to-white p-6 rounded-lg shadow-xl flex flex-col md:flex-row justify-between items-center space-x-6">
        <div class="flex items-center mb-4 md:mb-0">
            <img alt="Mascot with graduation cap and laptop"
                class="h-24 w-24 mr-4 rounded-full shadow-lg border-4 border-blue-300" height="96"
                src="https://storage.googleapis.com/a1aa/image/jkMHb8AzhA7TKNxKX9HTXEEhPDRBba7YsIg7S2ULP7mchf3JA.jpg"
                width="96" />
            <div>
                <p class="text-2xl font-semibold text-gray-800">
                    Selamat Datang,
                    <span class="font-extrabold text-blue-600">
                        {{ $mahasiswa->nama  }}
                    </span>
                </p>
                <p class="text-gray-600 mt-2">
                    Saat ini Anda berada di Halaman Mahasiswa
                </p>
                <p class="text-gray-500 mt-2">
                    Semangat terus, {{ $mahasiswa->nama  }}!
                </p>
                <p class="text-gray-500 mt-2">
                    Jaga semangat dan terus berusaha untuk mencapai tujuan akademik Anda!
                </p>
            </div>
        </div>
    </div>
    <div class="mt-6 bg-gray-100 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800">
            Status Akademik
        </h2>
        <p class="text-gray-600 mt-2">
            Periksa perkembangan akademik Anda dan tetap semangat dalam studi.
        </p>
    </div>
</body>

</html>
