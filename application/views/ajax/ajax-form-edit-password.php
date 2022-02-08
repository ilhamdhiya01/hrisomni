<style>
    .icon {
        position: absolute;
        right: 15px;
        top: 10px;
        cursor: pointer;
    }
</style>
<div class="icon">
    <i class="fa fa-times back" style="color: #899899;"></i>
</div>
<div class="p" style="padding:20px 25px;">
    <form>
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="">
            <small class="text-danger username"></small>
        </div>
        <div class="form-group">
            <label for="">Password Sekarang</label>
            <input type="password" name="password_sekarang" class="form-control" id="password_sekarang" placeholder="">
            <small class="text-danger password_sekarang"></small>
        </div>
        <div class="form-group">
            <label for="">Password Baru</label>
            <input type="password" name="password_baru" class="form-control" id="password_baru" placeholder="">
            <small class="text-danger password_baru"></small>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input show-password" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Show Password</label>
        </div>
        <button type="submit" class="btn btn-block btn-primary edit-password">Edit Password</button>
    </form>
</div>


<script>
    $(".back").click(function() {
        $.ajax({
            url: "<?= base_url() ?>profile/load_profile",
            type: "get",
            dataType: "html",
            success: function(data) {
                $(".card").html(data);
            }
        });
    });

    $(".show-password").click(function() {
        if ($(this).is(":checked")) {
            $("[name='password_sekarang']").attr("type", "text");
            $("[name='password_baru']").attr("type", "text");
        } else {
            $("[name='password_sekarang']").attr("type", "password");
            $("[name='password_baru']").attr("type", "password");
        }
    });

    $(".edit-password").click(function(a) {
        const username = $("#username").val();
        const password_sekarang = $("[name='password_sekarang']").val();
        const password_baru = $("[name='password_baru']").val();

        $.ajax({
            url: "<?= base_url(); ?>profile/ajax_edit_password_validation",
            type: "post",
            data: {
                username: username,
                password_sekarang: password_sekarang,
                password_baru: password_baru
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    if (data.error.username) {
                        $(".username").html(data.error.username);
                    } else {
                        $(".username").html("");
                    }

                    if (data.error.password_sekarang) {
                        $(".password_sekarang").html(data.error.password_sekarang);
                    } else {
                        $(".password_sekarang").html("");
                    }

                    if (data.error.password_baru) {
                        $(".password_baru").html(data.error.password_baru);
                    } else {
                        $(".password_baru").html("");
                    }
                } else {
                    $(".username").html("");
                    $(".password_sekarang").html("");
                    $(".password_baru").html("");

                    if (data.cek_username != username) {
                        $(".username").html("Username yang anda masukan salah");
                    } else {
                        $(".username").html("");
                        if (data.cek_password != true) {
                            $(".password_sekarang").html("Password yang anda masukan salah");
                        } else {
                            $(".password_sekarang").html("");
                            if (password_sekarang == password_baru) {
                                $(".password_baru").html("Password baru tidak boleh sama");
                            } else {
                                $(".password_baru").html("");
                                $.ajax({
                                    url: "<?= base_url(); ?>profile/proses_ubah_password",
                                    type: "post",
                                    data: {
                                        username: username,
                                        password_sekarang: password_sekarang,
                                        password_baru: password_baru
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        if (data.status == 200) {
                                            iziToast.success({
                                                title: 'Success',
                                                timeout: 3000,
                                                message: data.message,
                                                position: 'topCenter',
                                                transitionIn: 'flipInX',
                                                transitionOut: 'flipOutX'
                                            });

                                            $(".edit-username").attr("disabled", "disabled");
                                            $(".edit-password").attr("disabled", "disabled");
                                        }
                                    }
                                });
                            }
                        }
                    }
                }
            }
        });
        a.preventDefault();
    });
</script>