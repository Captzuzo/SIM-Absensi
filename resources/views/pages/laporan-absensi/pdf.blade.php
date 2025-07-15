<!DOCTYPE html>
<html>

<head>
    <title>Laporan Absensi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            font-size: 12px;
            padding: 6px;
        }
    </style>
</head>

<body>
    <h3 align="center">Laporan Absensi</h3>

    <table>
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $absen)
            <tr>
                <td>{{ $absen->pegawai->nama }}</td>
                <td>{{ $absen->tanggal }}</td>
                <td>{{ $absen->jam_masuk ?? '-' }}</td>
                <td>{{ $absen->jam_pulang ?? '-' }}</td>
                <td>{{ ucfirst($absen->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>