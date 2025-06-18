

<?php $__env->startSection('title', 'Edit Nilai Siswa'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit Nilai - <?php echo e($siswa->namasiswa); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('nilai.update', ['siswa_id' => $siswa->nisn, 'mapel_id' => $mapel->id])); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <input type="text" class="form-control" value="<?php echo e($mapel->nama_mapel); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text" class="form-control" value="<?php echo e($mapel->semester); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nilai_pengetahuan">Nilai Pengetahuan</label>
                        <input type="number" class="form-control" id="nilai_pengetahuan" name="nilai_pengetahuan"
                            value="<?php echo e($nilai->nilai_pengetahuan ?? ''); ?>" min="0" max="100" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_keterampilan">Nilai Keterampilan</label>
                        <input type="number" class="form-control" id="nilai_keterampilan" name="nilai_keterampilan"
                            value="<?php echo e($nilai->nilai_keterampilan ?? ''); ?>" min="0" max="100" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="<?php echo e(route('siswa.show', $siswa->nisn)); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/akn59-aabw.my.id/eligible.akn59-aabw.my.id/resources/views/nilai/edit.blade.php ENDPATH**/ ?>