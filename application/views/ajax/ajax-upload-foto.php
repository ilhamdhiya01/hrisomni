<style>
    .icon {
        position: absolute;
        right: 15px;
        top: 10px;
        cursor: pointer;
    }

    .edit-foto {
        position: relative;
        top: 60px;
    }

    .foto-profile {
        position: relative;
        top: 20px;
        left: 35px;
    }
</style>
<div class="icon">
    <i class="fa fa-times back" style="color: #899899;"></i>
</div>
<div class="p" style="padding:20px 25px;">
    <form action="<?= base_url(); ?>profile/edit_img_profile/<?= $this->session->userdata('id_user'); ?>" method="post" enctype="multipart/form-data">
        <center>
            <img src="<?= base_url() ?>uploads/<?= $this->fungsi->user_login()->gambar ?>" width="150" class="img-circle user-image">
            <input type="file" name="gambar" class="foto-profile">
        </center>
        <button type="submit" class="btn btn-block btn-primary edit-foto">Edit Gambar</button>
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
</script>