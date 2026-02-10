<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2>LAPORAN PEMINJAMAN ALAT MUSIK</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama User</th>
        <th>Alat</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
    </tr>

    @foreach($data as $i => $p)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $p->user->name ?? '-' }}</td>
        <td>{{ $p->alat->nama ?? '-' }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>{{ $p->tanggal_kembali ?? '-' }}</td>
        <td>{{ ucfirst($p->status) }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
