

<?php $__env->startSection('title', 'siswa'); ?>

<?php $__env->startSection('breadcrums'); ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>siswa</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <a href="<?php echo e(url('nilai/add')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="form-group float-right">
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Cari nama siswa atau NISN..." style="width: 250px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="nilaiTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" width="20px">No</th>
                        <th rowspan="2">NAMA SISWA</th>
                        <th rowspan="2">NISN</th>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <th colspan="2" class="text-center">SEMESTER <?php echo e($i); ?></th>
                        <?php endfor; ?>
                        <th rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <th>Pengetahuan</th>
                            <th>Keterampilan</th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($row['nama']); ?></td>
                            <td><?php echo e($row['nisn']); ?></td>

                            <?php for($sem = 1; $sem <= 5; $sem++): ?>
                                <td
                                    class="<?php echo e(is_numeric($row['semester'][$sem]['pengetahuan']['rata']) ? 'text-primary font-weight-bold' : ''); ?>">
                                    <?php echo e($row['semester'][$sem]['pengetahuan']['rata']); ?>

                                </td>
                                <td
                                    class="<?php echo e(is_numeric($row['semester'][$sem]['keterampilan']['rata']) ? 'text-success font-weight-bold' : ''); ?>">
                                    <?php echo e($row['semester'][$sem]['keterampilan']['rata']); ?>

                                </td>
                            <?php endfor; ?>
                            <td class="text-center">
                                <a href="<?php echo e(url('nilai/edit/' . $row['nisn'])); ?>" class="btn btn-xs btn-warning"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e(3 + 5 * 2 + 1); ?>" class="text-center">Tidak ada data siswa</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            // Initialize search functionality
            $('#searchInput').keyup(function() {
                var searchText = $(this).val().toLowerCase();

                $('#nilaiTable tbody tr').each(function() {
                    var namaSiswa = $(this).find('td:eq(1)').text().toLowerCase();
                    var nisn = $(this).find('td:eq(2)').text().toLowerCase();

                    if (namaSiswa.includes(searchText) || nisn.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            function add_sukses() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'success',
                    title: ' &nbsp; Tambah Data Berhasil'
                });
            }

            function edit_sukses() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'success',
                    title: ' &nbsp; Update Data Berhasil'
                });
            }

            function delete_sukses() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'success',
                    title: ' &nbsp; Hapus Data Berhasil'
                });
            }

            window.del = function(id) {
                Swal.fire({
                    title: "Ingin Menghapus Data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?php echo e(url('siswa/siswa/delete')); ?>/" + id;
                    }
                });
            }

            <?php if(session('add_sukses')): ?>
                add_sukses();
            <?php endif; ?>

            <?php if(session('edit_sukses')): ?>
                edit_sukses();
            <?php endif; ?>

            <?php if(session('delete_sukses')): ?>
                delete_sukses();
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eligible\resources\views/nilai/index.blade.php ENDPATH**/ ?>