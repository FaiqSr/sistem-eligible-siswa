<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?> - Eligible</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/fontawesome-free/css/all.min.css">


    <!-- DataTables -->
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo e(asset('adminlte')); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/dist/css/adminlte.min.css">



    <!-- pace-progress -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/pace-progress/themes/black/pace-theme-flat-top.css">

    <link rel="icon" href="<?php echo e(asset('adminlte')); ?>/dist/img/logo.png" type="image/png" sizes="16x16">
    <style>
        .main-sidebar {
            background-color: #2a375c !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini pace-primary">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo e(url('dashboard')); ?>" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown show">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true" class="nav-link dropdown-toggle">
                        <i class="fas fa-user-circle mr-2 text-lg"></i>
                        <span
                            class="hidden-xs"><?php echo e(ucfirst(DB::table('tbl_user')->find(session()->get('id_user'))->nama_lengkap)); ?></span>
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"
                        style="left: 0px; right: inherit;">
                        <li>
                            <a href="<?php echo e(url('profil')); ?>" class="dropdown-item">
                                <i class="nav-icon fas fa-user-secret"></i> Profil
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="<?php echo e(url('logout')); ?>" class="dropdown-item">
                                <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>

        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="#" class="brand-link text-center">
                <span class="brand-text text-white">Eligible</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo e(url('img/profil/men.png')); ?>" class="img-circle elevation-2">
                    </div>
                    <div class="info">
                        <a href="#"
                            class="d-block"><?php echo e(ucfirst(DB::table('tbl_user')->find(session()->get('id_user'))->nama_lengkap)); ?>

                            <br>
                            <span
                                class="small"><?php echo e(DB::table('tbl_user')->find(session()->get('id_user'))->email); ?></span>
                        </a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-header">Master Data</li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('ganti_setting')); ?>"
                                class="nav-link <?php echo e(request()->is('ganti_setting') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Profil Sekolah
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('siswa/rombonganbelajar')); ?>"
                                class="nav-link <?php echo e(request()->is('siswa/rombonganbelajar') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Rombongan Belajar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('siswa/index')); ?>"
                                class="nav-link <?php echo e(request()->is('siswa/index') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Data Siswa
                                </p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('nilai')); ?>"
                                class="nav-link <?php echo e(request()->is('nilai') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Data Nilai Siswa
                                </p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('prestasi')); ?>"
                                class="nav-link <?php echo e(request()->is('prestasi') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Prestasi Siswa
                                </p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('hasilakhir')); ?>"
                                class="nav-link <?php echo e(request()->is('hasilakhir') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Hasil Akhir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('surat')); ?>"
                                class="nav-link <?php echo e(request()->is('surat') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Surat Keputusan
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">User</li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('pengguna/index')); ?>"
                                class="nav-link <?php echo e(request()->is('pengguna/index') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo e(url('logout')); ?>" class="nav-link text-danger">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('breadcrums'); ?>
                </div>
            </section>

            <section class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </section>
        </div>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
            </div>

            <strong>Copyright &copy; 2024 <a href="#">Eligible</a>.</strong> All rights
            reserved.
        </footer>
    </div>



    <script src="<?php echo e(asset('adminlte')); ?>/plugins/jquery/jquery.min.js"></script>

    <script src="<?php echo e(asset('adminlte')); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo e(asset('adminlte')); ?>/dist/js/adminlte.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- pace-progress -->
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/pace-progress/pace.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/chart.js/Chart.min.js"></script>
    <script src="<?php echo e(asset('adminlte')); ?>/plugins/chart.js/Chart.min.js"></script>



    <script>
        $(function() {
            $('#table1').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    <?php echo $__env->yieldContent('script'); ?>

</body>

</html>
<?php /**PATH C:\laragon\www\elig\resources\views/layout/main.blade.php ENDPATH**/ ?>