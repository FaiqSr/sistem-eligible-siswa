

<?php $__env->startSection('title', 'Siswa Eligible'); ?>

<?php $__env->startSection('breadcrums'); ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Siswa Eligible</h1>
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
                    <h3 class="card-title">Hanya siswa yang terpilih menjadi eligible</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="form-inline float-right">
                        <div class="form-group mr-2">
                            <label for="filter-jurusan" class="mr-2">Filter Jurusan:</label>
                            <select id="filter-jurusan" class="form-control form-control-sm">
                                <option value="">Semua Jurusan</option>
                                <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($j->id); ?>"><?php echo e($j->rombongan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <a href="<?php echo e(route('hasilakhir.pdf', ['jurusan_id' => request('jurusan_id')])); ?>"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download PDF
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table-eligible" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Jurusan</th>
                        <th>Total Nilai Pengetahuan</th>
                        <th>Total Nilai Keterampilan</th>
                        <th>Total Nilai Prestasi</th>
                        <th>Total Keseluruhan</th>
                        <th>Peringkat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $eligibleSiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($siswa->namasiswa); ?></td>
                            <td><?php echo e($siswa->nisn); ?></td>
                            <td><?php echo e($siswa->rombongan->rombongan); ?></td>
                            <td><?php echo e($siswa->total_pengetahuan); ?></td>
                            <td><?php echo e($siswa->total_keterampilan); ?></td>
                            <td><?php echo e($siswa->jumlah_prestasi * 10); ?> (<?php echo e($siswa->jumlah_prestasi); ?> prestasi)</td>
                            <td><?php echo e($siswa->total_keseluruhan); ?></td>
                            <td><?php echo e($siswa->peringkat); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('hasilakhir.detail.pdf', $siswa->id)); ?>" class="btn btn-xs btn-info"
                                    title="Download PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
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
            var table = $('#table-eligible').DataTable({
                "order": [
                    [7, "desc"]
                ], // Default sort by Total Keseluruhan descending
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 9]
                    } // Disable sorting for No and Aksi columns
                ]
            });

            // Jurusan filter functionality
            $('#filter-jurusan').change(function() {
                var selectedJurusan = $(this).val();

                if (selectedJurusan === '') {
                    table.columns(3).search('').draw();
                } else {
                    // Get jurusan name from option text
                    var jurusanName = $(this).find('option:selected').text();
                    table.columns(3).search(jurusanName).draw();
                }
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

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/akn59-aabw.my.id/eligible.akn59-aabw.my.id/resources/views/hasilakhir/index.blade.php ENDPATH**/ ?>