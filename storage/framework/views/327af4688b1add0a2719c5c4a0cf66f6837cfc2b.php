

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
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col">
            <form action="<?php echo e(url('nilai/add')); ?>" method="post">
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
                                    <label>NISN</label>
                                    <select name="nisn" id="nisn" class="form-control">
                                        <option value="" selected>Pilih NISN</option>
                                        <?php $__currentLoopData = $nisn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($siswa->nisn); ?>"><?php echo e($siswa->nisn); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>JURUSAN</label>
                                    <select name="jurusan" id="jurusan" class="form-control" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SEMESTER</label>
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="">-- Pilih Semester --</option>
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <option value="<?php echo e($i); ?>">Semester <?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mata Pelajaran</label>
                                    <select name="id_mapel" id="id_mapel" class="form-control">
                                        <option value="">-- Pilih Mapel --</option>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>" data-semester="<?php echo e($item->semester); ?>"
                                                data-jurusan="<?php echo e($item->rombongan->rombongan); ?>">
                                                <?php echo e($item->nama_mapel); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>NILAI KETERAMPILAN</label>
                                    <input type="text" class="form-control" name="nilai_keterampilan"
                                        id="nilai_keterampilan" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>NILAI PENGETAHUAN</label>
                                    <input type="text" class="form-control" name="nilai_pengetahuan"
                                        id="nilai_pengetahuan" autocomplete="off" required>
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
<?php $__env->startSection('script'); ?>

    <script>
        function filterMapel() {
            var selectedSemester = $('#semester').val();
            var selectedJurusan = $('#jurusan').val();

            $('#id_mapel option').each(function() {
                var optionSemester = $(this).data('semester');
                var optionJurusan = $(this).data('jurusan');

                // Tampilkan hanya jika semester dan jurusan cocok
                if (
                    (!selectedSemester || optionSemester == selectedSemester) &&
                    (!selectedJurusan || optionJurusan == selectedJurusan)
                ) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Reset dropdown setelah filter
            $('#id_mapel').val('');
        }

        $(document).ready(function() {
            $('#semester, #jurusan').on('change', filterMapel);

            // Trigger saat halaman load
            filterMapel();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/akn59-aabw.my.id/eligible.akn59-aabw.my.id/resources/views/nilai/add.blade.php ENDPATH**/ ?>