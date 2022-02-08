<center>
    <img src="<?= base_url() ?>uploads/<?= $this->fungsi->user_login()->gambar ?>" width="150" class="img-circle user-image">
    <br>
    <div class="data">
        <a href="" class="update-foto" style="position: relative; top:15px;"><i class="fa fa-camera"></i> Upload</a>
        <span style="position: relative; top:13px; padding:0 5px;">|</span>
        <a href="" class="update-data-pribadi" style="position: relative; top:15px;"><i class="fa fa-edit"></i> Edir Data Pribadi</a>
    </div>
    <h3 class="text-bold"><?= $this->fungsi->user_login()->nama_pegawai ?></h3>
    <p class="text-bold"><?= $this->fungsi->user_login()->divisi_d ?></p>
    <a class="btn btn-primary edit-password">Edit Password</a>
    <a class="btn btn-primary edit-username">Edit Username</a>
</center>

<script>
    $(".edit-password").click(function(e) {
        $.ajax({
            url: "<?= base_url() ?>profile/load_form_password",
            type: "get",
            dataType: "html",
            success: function(data) {
                $(".card").html(data);
            }
        });
        e.preventDefault();
    });

    $(".edit-username").click(function(e) {
        $.ajax({
            url: "<?= base_url() ?>profile/load_form_username",
            type: "get",
            dataType: "html",
            success: function(data) {
                $(".card").html(data);
            }
        });
        e.preventDefault();
    });

    $(".update-foto").click(function(e) {
        $.ajax({
            url: "<?= base_url() ?>profile/load_upload_foto",
            type: "get",
            dataType: "html",
            success: function(data) {
                $(".card").html(data);
            }
        });
        e.preventDefault();
    });

    $(".update-data-pribadi").click(function(e) {
        $(".card").css("width","400px");
        $(".card").css("height","780px");
        $.ajax({
            url: "<?= base_url() ?>profile/load_edit_data_diri",
            type: "get",
            dataType: "html",
            success: function(data) {
                $(".card").html(data);
            }
        });
        e.preventDefault();
    });
</script>