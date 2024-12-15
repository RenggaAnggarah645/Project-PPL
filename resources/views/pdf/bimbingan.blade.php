<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Bimbingan - {{ $bimbingan->first()->nama_mahasiswa }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .header {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 10px;
            vertical-align: top;
        }
        .info-table th {
            text-align: left;
            padding: 10px;
            background-color: #f2f2f2;
            width: 30%;
        }
        .signature-section {
            margin-top: 50px;
            width: 300px; /* Atur lebar kolom tanda tangan */
            margin-left: auto; /* Geser kolom ke kanan */
            text-align: center; /* Rata tengah teks di dalam kolom */
        }
        .signature-space {
            height: 50px;
        }
    </style>
</head>
<body>

    <h1>Hasil Bimbingan Akademik</h1>

    <table class="info-table">
        <tr>
            <th>Nama Mahasiswa</th>
            <td>: {{ $bimbingan->first()->nama_mahasiswa }}</td>
        </tr>
        <tr>
            <th>NPM</th>
            <td>: {{ $bimbingan->first()->npm }}</td>
        </tr>
        <tr>
            <th>Nama Dosen</th>
            <td>: {{ $bimbingan->first()->nama_dosen }}</td>
        </tr>
        <tr>
            <th>NIP</th>
            <td>: {{ $bimbingan->first()->nip }}</td>
        </tr>
        <tr>
            <th>Periode Akademik</th>
            <td>: {{ $bimbingan->first()->tahun_awal }} / {{ $bimbingan->first()->tahun_akhir }} - 
                {{ ucfirst($bimbingan->first()->semester) }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Tanggal Bimbingan</th>
                <th>Topik Pembahasan</th>
                <th>Uraian Pembahasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bimbingan as $b)
                <tr>
                    <td>{{ $b->tanggal_bimbingan }}</td>
                    <td>{{ $b->topik_pembahasan }}</td>
                    <td>{{ $b->uraian_pembahasan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <p><strong>Mengetahui,</strong></p>
        <p><strong>Dosen Pembimbing Akademik</strong></p>
        <p>Bengkulu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <div class="signature-space"></div>
        
        <p>{{ $bimbingan->first()->nama_dosen }}</p>
        <p>NIP: {{ $bimbingan->first()->nip }}</p>
    </div>

</body>
</html>
