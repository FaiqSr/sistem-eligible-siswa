

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Daftar Nilai per Semester - <?php echo e($siswa->namasiswa); ?> (NISN: <?php echo e($siswa->nisn); ?>)</h3>
                </div>
            </div>
            <div class="card-body">
                <?php $__currentLoopData = $dataPerSemester; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semesterData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-4">
                        <h4 class="bg-light p-2">Semester <?php echo e($semesterData['semester']); ?></h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Nilai Pengetahuan</th>
                                    <th class="text-center">Nilai Keterampilan</th>
                                    <th class="text-center">Rata-rata</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $semesterData['mata_pelajaran']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $mapel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e($mapel['nama_mapel']); ?></td>
                                        <td
                                            class="text-center <?php echo e($mapel['nilai_pengetahuan'] >= 75 ? 'text-success' : 'text-danger'); ?>">
                                            <?php echo e($mapel['nilai_pengetahuan']); ?>

                                        </td>
                                        <td
                                            class="text-center <?php echo e($mapel['nilai_keterampilan'] >= 75 ? 'text-success' : 'text-danger'); ?>">
                                            <?php echo e($mapel['nilai_keterampilan']); ?>

                                        </td>
                                        <td class="text-center font-weight-bold">
                                            <?php echo e($mapel['rata_rata']); ?>

                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('nilai.edit', ['siswa_id' => $siswa->nisn, 'mapel_id' => $mapel['id']])); ?>"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(count($dataPerSemester) === 0): ?>
                    <div class="alert alert-info">
                        Belum ada data nilai untuk siswa ini.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/akn59-aabw.my.id/eligible.akn59-aabw.my.id/resources/views/nilai/nilai.blade.php ENDPATH**/ ?>