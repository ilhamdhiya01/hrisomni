<section class="content-header">
    <h1>
        Dashboard
        <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
        <li><a href="#">Dashboard</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="ccol-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content text-center">
                    <div class="flex">
                        <ul class="list-inline widget_profile_box">
                            <li>
                                <img src="<?= base_url() ?>uploads/<?= $this->fungsi->user_login()->gambar ?>" width="150" class="img-circle user-image">
                            </li>
                        </ul>
                    </div>
                    <div class="flex">
                        <ul class="list-inline count2">
                            <li>
                                <h1 class="name">Selamat Datang</h1>
                                <h3 class="name"><span class="hidden-xs"><?= $this->fungsi->user_login()->nama_pegawai ?></span></h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>