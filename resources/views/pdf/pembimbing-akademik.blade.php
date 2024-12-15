<!-- resources/views/pdf/pembimbing-akademik.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pembimbing Akademik</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; text-align: left; }
    </style>
</head>
<body>
    <h2>Daftar Pembimbing Akademik</h2>
    <table>
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Angkatan</th>
                <th>Pembimbing Akademik</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->npm }}</td>
                    <td>{{ $mahasiswa->nama_lengkap }}</td>
                    <td>{{ $mahasiswa->angkatan }}</td>
                    <td>{{ $mahasiswa->dosen_pembimbing->name ?? 'Belum ada pembimbing' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
