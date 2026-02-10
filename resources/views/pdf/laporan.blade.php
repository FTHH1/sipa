<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
        }

        th {
            background: #eee;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

<h2>Laporan Peminjaman Alat Musik</h2>

<table>
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Alat</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    @foreach($peminjamans as $i => $p)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $p->user->name ?? '-' }}</td>
        <td>{{ $p->alat->nama ?? '-' }}</td>
        <td>{{ $p->status }}</td>
        <td>{{ $p->created_at->format('d-m-Y') }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>
