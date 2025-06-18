

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
                    <a href="<?php echo e(url('prestasi/add')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="form-group float-right">
                        <label for="filter-jurusan" class="mr-2">Filter Jurusan:</label>
                        <select id="filter-jurusan" class="form-control form-control-sm" style="width: 150px;">
                            <option value="">Semua Jurusan</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th>NAMA SISWA</th>
                        <th>NISN</th>
                        <th>TYPE</th>
                        <th>NAMA PRESTASI</th>
                        <th>TANGGAL</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-jurusan="<?php echo e($item->siswa->rombongan->rombongan); ?>">
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->siswa->namasiswa); ?></td>
                            <td><?php echo e($item->siswa->nisn); ?></td>
                            <td><?php echo e($item->type); ?></td>
                            <td><?php echo e($item->nama_prestasi); ?></td>
                            <td><?php echo e($item->tanggal); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(url('siswa/edit/' . $item->id)); ?>" class="btn btn-xs btn-warning"
                                    title="Edit"><i class="fas fa-edit"></i> </a>
                                <button onclick="del(<?php echo e($item->id); ?>)" class="btn btn-xs btn-danger" title="Hapus"><i
                                        class="fas fa-trash"></i> </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            // Initialize DataTable if you're using it
            $('#table1').DataTable();

            // Jurusan filter functionality
            $('#filter-jurusan').change(function() {
                var selectedJurusan = $(this).val();

                $('#table1 tbody tr').each(function() {
                    var rowJurusan = $(this).data('jurusan');

                    if (selectedJurusan === '' || rowJurusan === selectedJurusan) {
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
        });

        <?php if(session('add_sukses')): ?>
            add_sukses();
        <?php endif; ?>

        <?php if(session('edit_sukses')): ?>
            edit_sukses();
        <?php endif; ?>

        <?php if(session('delete_sukses')): ?>
            delete_sukses();
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eligible\resources\views/prestasi/index.blade.php ENDPATH**/ ?>