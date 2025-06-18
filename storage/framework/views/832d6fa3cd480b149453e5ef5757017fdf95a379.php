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
    </style>
</head>

<body>
    <div class="header">
        <h3><?php echo e($nama_sekolah); ?></h3>
        <p><?php echo e($alamat_sekolah); ?></p>
    </div>

    <div class="title">
        <span class="underline">DAFTAR SISWA ELIGIBLE</span>
    </div>

    <div class="info">
        <p>Jurusan: <?php echo e($jurusan); ?></p>
        <p>Tanggal: <?php echo e($date); ?></p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Jurusan</th>
                <th>Total Pengetahuan</th>
                <th>Total Keterampilan</th>
                <th>Total Prestasi</th>
                <th>Total Keseluruhan</th>
                <th>Peringkat</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $siswaEligible; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($siswa->namasiswa); ?></td>
                    <td><?php echo e($siswa->nisn); ?></td>
                    <td><?php echo e($siswa->rombongan->rombongan); ?></td>
                    <td class="text-center"><?php echo e($siswa->total_pengetahuan); ?></td>
                    <td class="text-center"><?php echo e($siswa->total_keterampilan); ?></td>
                    <td class="text-center"><?php echo e($siswa->jumlah_prestasi * 10); ?> (<?php echo e($siswa->jumlah_prestasi); ?>)</td>
                    <td class="text-center"><?php echo e($siswa->total_keseluruhan); ?></td>
                    <td class="text-center"><?php echo e($siswa->peringkat); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?php echo e(date('d F Y H:i:s')); ?></p>
    </div>
</body>

</html>
<?php /**PATH /home/akn59-aabw.my.id/eligible.akn59-aabw.my.id/resources/views/pdf/siswa_eligible.blade.php ENDPATH**/ ?>