<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .title {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .underline {
            text-decoration: underline;
        }

        .info {
            margin-bottom: 15px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            font-size: 10pt;
            text-align: right;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            margin-top: 20px;
        }

        .summary-item {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>{{ $nama_sekolah }}</h3>
        <p>{{ $alamat_sekolah }}</p>
    </div>

    <div class="title">
        <span class="underline">DETAIL SISWA ELIGIBLE</span>
    </div>

    <div class="info">
        <p>Nama: {{ $siswa->namasiswa }}</p>
        <p>NISN: {{ $siswa->nisn }}</p>
        <p>Jurusan: {{ $siswa->rombongan->rombongan }}</p>
        <p>Tanggal: {{ $date }}</p>
    </div>

    <div class="summary">
        <div class="summary-item"><strong>Total Nilai Pengetahuan:</strong> {{ $total_pengetahuan }}</div>
        <div class="summary-item"><strong>Total Nilai Keterampilan:</strong> {{ $total_keterampilan }}</div>
        <div class="summary-item"><strong>Total Nilai Prestasi:</strong> {{ $jumlah_prestasi * 10 }}
            ({{ $jumlah_prestasi }} prestasi)</div>
        <div class="summary-item"><strong>Total Keseluruhan:</strong> {{ $total_keseluruhan }}</div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>

</html>
