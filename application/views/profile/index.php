<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        position: relative;
        width: 350px;
        height: 400px;
        padding: 30px 0;
        background-color: #FFFFFF;
        border-radius: 5%;
    }

    .card img {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
    }
</style>

<section class="content-header">
    <h1>
        Profile
        <small>Edit Profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
        <li><a href="#">Edit Profile</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="ccol-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <div class="card">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
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