<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 0;
        }
        p.tanggal {
            text-align: right;
            margin-top: 0;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>{{ $judul }}</h1>
    <p class="tanggal">Tanggal Cetak: {{ $tanggal }}</p>

    <table>
        <thead>
            <tr>
                <th>Bidang</th>
                <th>Jumlah Pengaduan</th>
                <th>Progress (Verifikasi / Proses / Selesai)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Rehsos</td>
                <td>{{ $countRehsos }}</td>
                <td>
                    @foreach($progressRehsos as $status => $jumlah)
                        {{ ucfirst($status) }}: {{ $jumlah }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>PPKG</td>
                <td>{{ $countPPKG }}</td>
                <td>
                    @foreach($progressPPKG as $status => $jumlah)
                        {{ ucfirst($status) }}: {{ $jumlah }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Dayasos</td>
                <td>{{ $countDayasos }}</td>
                <td>
                    @foreach($progressDayasos as $status => $jumlah)
                        {{ ucfirst($status) }}: {{ $jumlah }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Linjamsos</td>
                <td>{{ $countLinjamsos }}</td>
                <td>
                    @foreach($progressLinjamsos as $status => $jumlah)
                        {{ ucfirst($status) }}: {{ $jumlah }}<br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
