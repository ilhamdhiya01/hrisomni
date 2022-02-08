<section class="content-header">
    <h1>Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> </a></li>
        <li><a href="#">Users</a></li>

    </ol>
</section>


<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Users</h3>
            <div class="pull-right">
                <a href="<?= site_url('user') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <img src="<?= base_url(); ?>uploads/<?= $user_by_id['gambar']; ?>" width="120" alt="">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Foto Profile</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" value="<?= $user_by_id['gambar']; ?>" name="gambar" id="gambar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" class="form-control" value="<?= $user_by_id['nama_pegawai']; ?>" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai">
                            <small class="text-danger"><?= form_error('nama_pegawai'); ?></small>
                        </div>
                        <div style="display:none;" class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" value="<?= $user_by_id['username']; ?>" readonly name="username" id="username" placeholder="Username">
                            <small class="text-danger"><?= form_error('username'); ?></small>
                        </div>
                        <div style="display:none;" class="form-group">
                            <label for="password">Password Sekarang
                                <!-- <div class=""> -->
                                <input class="form-check-input" style="position:relative; left:5px; top:2px;" type="checkbox" value="" id="ubah-password"> <small style="position:relative; left:5px;">Ubah Password</small>
                                <!-- <small>
                                        Ubah Password
                                    </small>
                                </div> -->
                            </label>
                            <input type="password" class="form-control" value="<?= $user_by_id['password']; ?>" name="password" id="password" readonly placeholder="Password">
                            <small class="text-danger"><?= form_error('password'); ?></small>
                        </div>
                        <div style="display:none;" class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            <input type="password" class="form-control" value="<?= $user_by_id['password']; ?>" name="konfirmasi_password" id="konfirmasi_password" readonly placeholder="Konfirmasi Password">
                            <small class="text-danger"><?= form_error('konfirmasi_password'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <select class="form-control" name="divisi" id="divisi">
                                <option>--Pilih--</option>
                                <?php foreach ($divisies as $divisi) : ?>
                                    <?php if ($user_by_id['divisi_id'] == $divisi['id_divisi']) : ?>
                                        <option value="<?= $divisi['id_divisi']; ?>" selected><?= $divisi['divisi_d']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $divisi['id_divisi']; ?>"><?= $divisi['divisi_d']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" name="level" id="level">
                                <option>--Pilih--</option>
                                <?php foreach ($levels as $level) : ?>
                                    <?php if ($user_by_id['level_id'] == $level['id']) : ?>
                                        <option value="<?= $level['id']; ?>" selected><?= $level['level']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $level['id']; ?>"><?= $level['level']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">
                                <i class="fa fa-paper-plane"></i> Simpan
                            </button>
                            <button type="Reset" class="btn btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $("#span").hover(function() {
        $(this).css('cursor', 'pointer');
    });
    $("#ubah-password").click(function() {
        if ($(this).is(':checked')) {
            $("[name='password']").removeAttr("readonly");
            $("[name='konfirmasi_password']").removeAttr("readonly");
        } else {
            $("[name='password']").attr("readonly", "readonly");
            $("[name='konfirmasi_password']").attr("readonly", "readonly");
        }
    });
</script>