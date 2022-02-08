<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HRIS Omni | Home</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/izitoast/dist/css/iziToast.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= base_url() ?>assets/index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->

                <!-- logo for regular state and mobile devices -->
                <span class="logo-mini"><b>OE</b></span>
                <span class="logo-lg"><b>HRIS</b> PT OMNI</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Notifications: style can be found in dropdown.less -->
                        <?php if ($this->session->userdata('level_id') == 1) : ?>
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <?php
                                    $this->db->select('pengajuan_cuti.*, level_id, nama_pegawai, divisi_d');
                                    $this->db->join('users', 'pengajuan_cuti.user_id = users.id');
                                    $this->db->join('divisi', 'pengajuan_cuti.divisi_id = divisi.id_divisi');
                                    $this->db->where('level_id', 2);
                                    $this->db->where('created_at', date('d-m-Y'));
                                    $this->db->limit(5);
                                    $this->db->order_by('id', 'DESC');
                                    $notifikasi = $this->db->get('pengajuan_cuti')->result_array();
                                    if (count($notifikasi) == 0) :
                                    ?>
                                        <span class="label label-danger"></span>
                                    <?php else : ?>
                                        <span class="label label-danger"><?= count($notifikasi); ?></span>
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have <?= count($notifikasi); ?> notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <?php foreach ($notifikasi as $notif) : ?>
                                                <li>
                                                    <a href="<?= base_url('approval'); ?>">
                                                        <i class="fa fa-exclamation text-warning"></i> <?= $notif['nama_pegawai'] . ' ' . '(' . $notif['divisi_d'] . ')'; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="<?= base_url('approval'); ?>">View all</a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <?php
                                    $this->db->select('notif_staff.*, pengajuan_cuti.keperluan, pengajuan_cuti.created_at, pengajuan_cuti.lama');
                                    $this->db->join('pengajuan_cuti', 'notif_staff.cuti_id = pengajuan_cuti.id');
                                    $this->db->where('notif_staff.user_id', $this->session->userdata('id_user'));
                                    $this->db->where('approve_at', date('d-m-Y'));
                                    $this->db->limit(5);
                                    $this->db->order_by('id', 'DESC');
                                    $notif_staff = $this->db->get('notif_staff')->result_array();
                                    if (count($notif_staff) == 0) :
                                    ?>
                                        <span class="label label-danger"></span>
                                    <?php else : ?>
                                        <span class="label label-danger"><?= count($notif_staff); ?></span>
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have <?= count($notif_staff); ?> notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <?php foreach ($notif_staff as $staff) : ?>
                                                <li>
                                                    <a href="<?= base_url('cuti'); ?>">
                                                        <?php if ($staff['status'] == 1) : ?>
                                                            <i class="fa fa-check text-success"></i> <?= $staff['keperluan'] . ' selama ' . $staff['lama'] ?> disetujui
                                                        <?php else : ?>
                                                            <i class="fa fa-times text-danger"></i> <?= $staff['keperluan'] . ' selama ' . $staff['lama'] ?> ditolak
                                                        <?php endif; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="<?= base_url('cuti'); ?>">View all</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <!-- Tasks: style can be found in dropdown.less -->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url() ?>uploads/<?= $this->fungsi->user_login()->gambar ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $this->fungsi->user_login()->nama_pegawai ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= base_url() ?>uploads/<?= $this->fungsi->user_login()->gambar ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $this->fungsi->user_login()->level ?>
                                        <small><?= $this->fungsi->user_login()->divisi_d ?></small>
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat bg-red">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url() ?>uploads/<?= $this->fungsi->user_login()->gambar ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= ucfirst($this->fungsi->user_login()->nama_pegawai) ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">GENERAL</li>
                    <li <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                        <a href="<?= site_url('dashboard') ?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>


                    <li <?= $this->uri->segment(1) == 'cuti' ? 'class="active"' : '' ?>><a href="<?= site_url('cuti') ?>">
                            <i class="fa fa-calendar"></i> <span>Pengajuan Cuti</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>


                    <li <?= $this->uri->segment(1) == 'absensi' ? 'class="active"' : '' ?>>
                        <a href="<?= site_url('absensi') ?>">
                            <i class="fa fa-check-circle"></i> <span>Absensi</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <?php if ($this->fungsi->user_login()->level_id == 1) { ?>
                        <li class="header">MENU KHUSUS</li>
                        <li <?= $this->uri->segment(1) == 'approval' ? 'class="active"' : '' ?>><a href="<?= site_url('approval') ?>"><i class="fa fa-calendar"></i> <span>Approval Cuti</span></a></li>
                        <li <?= $this->uri->segment(1) == 'user' ? 'class="active"' : '' ?>><a href="<?= site_url('user') ?>"><i class="fa fa-user"></i> <span>User</span></a></li>
                        <li <?= $this->uri->segment(1) == 'data' ? 'class="active"' : '' ?>><a href="<?= site_url('data') ?>"><i class="fa fa-users"></i> <span>Data Karyawan</span></a></li>
                        <li <?= $this->uri->segment(1) == 'divisi' ? 'class="active"' : '' ?>><a href="<?= site_url('divisi') ?>"><i class="fa fa-building"></i> <span>Departemen</span></a></li>
                    <?php } ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $contents ?>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">

            </div>
            <strong>Copyright &copy; 2021 | PT Omni Electrindo</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?= base_url() ?>assets/plugins/izitoast/dist/js/iziToast.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/dist/js/demo.js"></script> -->

    <script src="<?= base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.sidebar-menu').tree()
            $('#table1').DataTable()
        })
    </script>
</body>

</html>