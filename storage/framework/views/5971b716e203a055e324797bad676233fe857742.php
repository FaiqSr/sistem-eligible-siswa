

<?php $__env->startSection('title', 'siswa'); ?>

<?php $__env->startSection('breadcrums'); ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tambah Data</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo e(url('prestasi/add')); ?>" method="post">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="ml-auto">
                                    <a href="<?php echo e(url('prestasi/')); ?>" class="btn btn-default">
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
                                    <label>NISN</label>
                                    <select name="nisn" id="nisn" class="form-control">
                                        <option value="">Pilih NISN</option>
                                        <?php $__currentLoopData = $nisn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->nisn); ?>"><?php echo e($item->nisn); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>NAMA PRESTASI</label>
                                    <input type="text" class="form-control" name="namaPrestasi" id="namaPrestasi"
                                        autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>JENIS</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="internasional">Internasional</option>
                                        <option value="nasional">Nasional</option>
                                        <option value="provinsi">Provinsi</option>
                                        <option value="kabupaten">Kabupaten</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                                        autocomplete="off" required>
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/akn59-aabw.my.id/eligible.akn59-aabw.my.id/resources/views/prestasi/add.blade.php ENDPATH**/ ?>