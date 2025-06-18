

<?php $__env->startSection('title', 'Surat Keputusan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Pembuatan Surat Keputusan</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('surat.generate')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                </div>
                <div class="form-group">
                    <label for="nama_kepala">Nama Kepala Sekolah</label>
                    <input type="text" class="form-control" id="nama_kepala" name="nama_kepala" required>
                </div>
                <div class="form-group">
                    <label for="jurusan_id">Jurusan</label>
                    <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                        <option value="">Pilih Jurusan</option>
                        <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($j->id); ?>"><?php echo e($j->rombongan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> Generate PDF
                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/akn59-aabw.my.id/eligible.akn59-aabw.my.id/resources/views/surat/index.blade.php ENDPATH**/ ?>