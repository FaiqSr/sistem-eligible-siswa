<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo e($title); ?></title>
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
        <h3><?php echo e($nama_sekolah); ?></h3>
        <p><?php echo e($alamat_sekolah); ?></p>
    </div>

    <div class="title">
        <span class="underline">DETAIL SISWA ELIGIBLE</span>
    </div>

    <div class="info">
        <p>Nama: <?php echo e($siswa->namasiswa); ?></p>
        <p>NISN: <?php echo e($siswa->nisn); ?></p>
        <p>Jurusan: <?php echo e($siswa->rombongan->rombongan); ?></p>
        <p>Tanggal: <?php echo e($date); ?></p>
    </div>

    <div class="summary">
        <div class="summary-item"><strong>Total Nilai Pengetahuan:</strong> <?php echo e($total_pengetahuan); ?></div>
        <div class="summary-item"><strong>Total Nilai Keterampilan:</strong> <?php echo e($total_keterampilan); ?></div>
        <div class="summary-item"><strong>Total Nilai Prestasi:</strong> <?php echo e($jumlah_prestasi * 10); ?>

            (<?php echo e($jumlah_prestasi); ?> prestasi)</div>
        <div class="summary-item"><strong>Total Keseluruhan:</strong> <?php echo e($total_keseluruhan); ?></div>
    </div>

    <div class="footer">
        <p>Dicetak pada: <?php echo e(date('d F Y H:i:s')); ?></p>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\eligible\resources\views/pdf/siswa_eligible_detail.blade.php ENDPATH**/ ?>