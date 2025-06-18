

<?php $__env->startSection('title', 'Siswa'); ?>

<?php $__env->startSection('breadcrums'); ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Siswa</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo e(url('siswa/edit')); ?>" method="post">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="ml-auto">
                                    <a href="<?php echo e(url('siswa/index')); ?>" class="btn btn-default">
                                        <i class="fas fa fa-reply"></i> Kembali </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>NAMA SISWA</label>
                                    <input type="text" class="form-control" name="namasiswa" id="namasiswa"
                                        autocomplete="off" value="<?php echo e($row->namasiswa); ?>" required>
                                    <input type="hidden" name="id" value="<?php echo e($row->id); ?>">
                                </div>
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="text" class="form-control" name="nisn" id="nisn"
                                        autocomplete="off" value="<?php echo e($row->nisn); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>JENIS KELAMIN</label>
                                    <input type="text" class="form-control" name="jeniskelamin" id="jeniskelamin"
                                        autocomplete="off" value="<?php echo e($row->jeniskelamin); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eligible\resources\views/siswa/edit.blade.php ENDPATH**/ ?>