<?php
$uri = service('uri');
$menu = $uri->getSegment(1);
$submenu = $uri->getSegment(2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/assets/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Toast -->
    <link rel="stylesheet" href="/assets/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
</head>

<body class="layout-fixed text-sm layout-navbar-fixed" id="awak">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item" id="coll">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="/assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="/assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="/assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/assets/index3.html" class="brand-link">
                <img src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin KSP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($submenu == 'koperasi' || $submenu == 'anggota' || $submenu == 'jenistransaksi') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?= ($submenu == 'koperasi' || $submenu == 'anggota' || $submenu == 'jenistransaksi') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Data
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/koperasi" class="nav-link <?= ($submenu == 'koperasi') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Koperasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/jenistransaksi" class="nav-link <?= ($submenu == 'jenistransaksi') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jenis Transaksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/anggota" class="nav-link <?= ($submenu == 'anggota') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Anggota</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item <?= ($submenu == 'debet') ? 'active' : ''; ?>">
                            <a href="/admin/debet" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Transaksi Debet
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($submenu == 'kredit') ? 'active' : ''; ?>">
                            <a href="/admin/kredit" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Transaksi Kredit
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($submenu == 'bku' || $submenu == 'bkbesar') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?= ($submenu == 'bku' || $submenu == 'bkbesar') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/bku" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../charts/flot.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Flot</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../charts/inline.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inline</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../charts/uplot.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>uPlot</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->renderSection('content') ?>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/assets/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- InputMask -->
    <script src="/assets/moment/moment.min.js"></script>
    <script src="/assets/inputmask/jquery.inputmask.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/select2/js/select2.full.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="/assets/sweetalert2/sweetalert2.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/jszip/jszip.min.js"></script>
    <script src="/assets/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/assets/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- date-range-picker -->
    <script src="/assets/daterangepicker/daterangepicker.js"></script>
    <!-- Toast -->
    <script src="/assets/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script src="/assets/js-app/admin-page.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            toastr.error("<?= session()->getFlashdata('error'); ?>");
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            toastr.success("<?= session()->getFlashdata('success'); ?>");
        </script>
    <?php endif; ?>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        var gaya = localStorage.getItem("gaya");
        if (gaya) {
            $("#awak").attr("class", gaya)
        }
        $("#coll").on('click', function() {
            if (gaya) {
                localStorage.removeItem('gaya')
            } else {
                localStorage.setItem('gaya', 'layout-fixed text-sm layout-navbar-fixed sidebar-collapse');
            }
        })
    </script>

    <script>
        $(function() {
            $('#example2').DataTable({
                stateSave: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            //Date range picker
            $('#reservation').daterangepicker()
        })
    </script>

    <!-- <script>
        // Input Mask
        /* Dengan Rupiah */
        var dr = document.getElementsByClassName("dengan-rupiah");
        $('.dengan-rupiah').on("keyup", function() {
            $(this).val(formatRupiah(this.value, "Rp. "));
        })
        $('.dengan-rupiah').on("click", function() {
            $(this).val(formatRupiah(this.value, "Rp. "));
        })

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script> -->
</body>

</html>