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
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="">
            <small class="text-danger password"></small>
        </div>
        <div class="form-group">
            <label for="username_sekarang">Username Sekarang</label>
            <input type="text" name="username_sekarang" class="form-control" id="username_sekarang" placeholder="">
            <small class="text-danger username_sekarang"></small>
        </div>
        <div class="form-group">
            <label for="username_baru">Username Baru</label>
            <input type="text" name="username_baru" class="form-control" id="username_baru" placeholder="">
            <small class="text-danger username_baru"></small>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input show-password" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Show Password</label>
        </div>
        <button type="submit" class="btn btn-block btn-primary edit-username">Edit Username</button>
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
            $("[name='password']").attr("type", "text");
        } else {
            $("[name='password']").attr("type", "password");
        }
    });

    $(".edit-username").click(function(e) {
        const password = $("#password").val();
        const username_sekarang = $("#username_sekarang").val();
        const username_baru = $("#username_baru").val();

        $.ajax({
            url: "<?= base_url(); ?>profile/ajax_edit_username_validation",
            type: "post",
            dataType: "json",
            data: {
                password: password,
                username_sekarang: username_sekarang,
                username_baru: username_baru
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.password) {
                        $(".password").html(data.error.password);
                    } else {
                        $(".password").html("");
                    }

                    if (data.error.username_sekarang) {
                        $(".username_sekarang").html(data.error.username_sekarang);
                    } else {
                        $(".username_sekarang").html("");
                    }

                    if (data.error.username_baru) {
                        $(".username_baru").html(data.error.username_baru);
                    } else {
                        $(".username_baru").html("");
                    }
                } else {
                    $(".password").html("");
                    $(".username_sekarang").html("");
                    $(".username_baru").html("");

                    if (data.cek_password != true) {
                        $(".password").html("Password yang anda masukan salah");
                    } else {
                        $(".password").html("");
                        if (username_sekarang != data.cek_username_sekarang) {
                            $(".username_sekarang").html("Username yang anda masukan salah");
                        } else {
                            $(".username_sekarang").html("");
                            if (username_baru == username_sekarang) {
                                $(".username_baru").html("Username tidak boleh sama dengan sebelumnya");
                            } else {
                                $(".username_baru").html("");
                                $.ajax({
                                    url: "<?= base_url(); ?>profile/proses_ubah_username",
                                    type: "post",
                                    data: {
                                        username_baru: username_baru
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
                                            
                                            $(".edit-username").attr("disabled","disabled");
                                            $(".edit-password").attr("disabled","disabled");

                                            setTimeout(() => {
                                                window.location = "<?= base_url() ?>auth/logout";
                                            }, 3000);
                                        }
                                    }
                                });
                            }
                        }
                    }
                }
            }
        });
        e.preventDefault();
    });
</script>