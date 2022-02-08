<section class="content-header">
    <h1>Edit data pengajuan Cuti
        <small>Ajukan Cuti</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-calendar"></i> </a></li>
        <li class="active">Ajukan Cuti</li>

    </ol>
</section>

<!-- Main content -->

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Users</h3>
        </div>
        <div class="box-body table-responsive">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <select class="js-example-basic-single" style="width: 338px;" name="nama_pegawai">
                                <option></option>
                                <?php foreach ($users as $user) : ?>
                                    <?php if ($cuti_by_id['user_id'] == $user['id']) : ?>
                                        <option value="<?= $user['id']; ?>" selected><?= $user['nama_pegawai']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $user['id']; ?>"><?= $user['nama_pegawai']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger"><?= form_error('nama_pegawai'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <select class="form-control" name="divisi" id="divisi">
                                <option></option>
                                <?php foreach ($divisies as $divisi) : ?>
                                    <?php if ($cuti_by_id['divisi_id'] == $divisi['id_divisi']) : ?>
                                        <option value="<?= $divisi['id_divisi']; ?>" selected><?= $divisi['divisi_d']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $divisi['id_divisi']; ?>"><?= $divisi['divisi_d']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger"><?= form_error('divisi'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="divisi">Keperluan Curi</label>
                            <select class="form-control" name="keperluan" id="keperluan">
                                <option></option>
                                <?php if ($cuti_by_id['keperluan'] == "Cuti Sakit") : ?>
                                    <option value="Cuti Sakit" selected>Cuti Sakit</option>
                                    <option value="Cuti Hamil">Cuti Hamil</option>
                                    <option value="Cuti Lain-lain">Cuti Lain-lain</option>
                                <?php endif; ?>
                                <?php if ($cuti_by_id['keperluan'] == "Cuti Hamil") : ?>
                                    <option value="Cuti Sakit">Cuti Sakit</option>
                                    <option value="Cuti Hamil" selected>Cuti Hamil</option>
                                    <option value="Cuti Lain-lain">Cuti Lain-lain</option>
                                <?php endif; ?>
                                <?php if ($cuti_by_id['keperluan'] == "Cuti Lain-lain") : ?>
                                    <option value="Cuti Sakit">Cuti Sakit</option>
                                    <option value="Cuti Hamil">Cuti Hamil</option>
                                    <option value="Cuti Lain-lain" selected>Cuti Lain-lain</option>
                                <?php endif; ?>
                            </select>
                            <small class="text-danger"><?= form_error('keperluan'); ?></small>
                        </div>
                        <!-- <div class="form-group ">
                            <label>Keperluan <small class="text-danger">*</small></label>
                            <textarea name="keperluan" value="" class="form-control"></textarea>
                            <small class="text-danger"><?= form_error('keperluan'); ?></small>
                        </div> -->
                        <div class="form-group ">
                            <label for="username" id="tes">Mulai <small class="text-danger">*</small></label>
                            <input type="text" name="tgl_mulai" value="<?= $cuti_by_id['tgl_mulai'] ?>" autocomplete="off" id="tgl_mulai" class="form-control input-tanggal-mulai">
                            <small class="text-danger"><?= form_error('tgl_mulai'); ?></small>
                        </div>
                        <div class="form-group ">
                            <label for="username">Sampai <small class="text-danger">*</small></label>
                            <input type="text" value="<?= $cuti_by_id['tgl_sampai'] ?>" name="tgl_sampai" id="tgl_sampai" autocomplete="off" class="form-control input-tanggal-sampai">
                            <small class="text-danger"><?= form_error('tgl_sampai'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="username">Lama</label>
                            <input type="text" value="<?= $cuti_by_id['lama'] ?>" readonly class="form-control" value="" name="lama" id="">
                            <small class="text-danger over-cuti"></small>
                        </div>
                        <div class="form-group ">
                            <label>Keterangan <small class="text-danger">*</small></label>
                            <textarea name="keterangan" value="<?= $cuti_by_id['keterangan'] ?>" class="form-control"><?= $cuti_by_id['keterangan'] ?></textarea>
                            <small class="text-danger"><?= form_error('keterangan'); ?></small>
                        </div>
                        <div class="form-group ">
                            <?php if ($cuti_by_id['status'] == 1) : ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" checked value="1" id="status" name="status" class="custom-control-input">
                                    <label class="custom-control-label" for="status">Setujui</label>
                                </div>
                            <?php else : ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="status" value="1" name="status" class="custom-control-input">
                                    <label class="custom-control-label" for="status">Setujui</label>
                                </div>
                            <?php endif; ?>
                            <?php if ($cuti_by_id['status'] == 0) : ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" checked id="status" name="status" class="custom-control-input">
                                    <label class="custom-control-label" value="0" for="status2">Tolak</label>
                                </div>
                            <?php else : ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="status" name="status" class="custom-control-input">
                                    <label class="custom-control-label" value="0" for="status">Tolak</label>
                                </div>
                            <?php endif; ?>
                            <?php if ($cuti_by_id['status'] == 2) : ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" checked id="status" name="status" class="custom-control-input">
                                    <label class="custom-control-label" value="2" for="status2">Menunggu</label>
                                </div>
                            <?php else : ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="status" name="status" class="custom-control-input">
                                    <label class="custom-control-label" value="2" for="status">Menunggu</label>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat btn-simpan-cuti">
                                <i class="fa fa-paper-plane"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.input-tanggal-mulai').datepicker();
        $('.input-tanggal-sampai').datepicker();
    });

    // var d = new Date("1 14 2012");
    // console.log(d.toLocaleDateString());
    // d.setMonth(d.getMonth() + 3);
    // console.log(d.toLocaleDateString());

    $("[name='keperluan']").change(function() {
        switch ($(this).val()) {
            case "Cuti Sakit":
            case "Cuti Lain-lain":
                $("[name='tgl_mulai']").val("");
                $("[name='tgl_sampai']").val("");
                $("[name='lama']").val("");

                $("[name='tgl_sampai']").removeAttr("disabled");
                $("[name='tgl_mulai']").change(function() {
                    const mulai = $(this).val();
                    const tanggal_mulai = mulai.split("", 5)[3] + mulai.split("", 5)[4]
                    const bulan_mulai = mulai.split("", 5)[0] + mulai.split("", 5)[1]
                    console.log(bulan_mulai)

                    $("[name='tgl_sampai']").change(function() {
                        const sampai = $(this).val();
                        const tanggal_sampai = sampai.split("", 5)[3] + sampai.split("", 5)[4]
                        const bulan_sampai = sampai.split("", 5)[0] + sampai.split("", 5)[1]

                        // cuti personal
                        const present_date = new Date(2022, bulan_mulai, 0).getDate();
                        if (bulan_mulai < bulan_sampai) {
                            const total_cuti = present_date - Number(tanggal_mulai) + Number(tanggal_sampai)
                            if (total_cuti > 12) {
                                $("[name='lama']").attr("style", "border: 1px solid red;")
                                $(".over-cuti").html("Masa cuti maksimal 12 hari dalam 1 tahun !")
                                $(".btn-simpan-cuti").attr("disabled", "disabled");
                            } else {
                                if (total_cuti < 0) {
                                    $("[name='lama']").attr("style", "border: 1px solid red;")
                                    $(".over-cuti").html("Format tanggal cuti salah !")
                                    $(".btn-simpan-cuti").attr("disabled", "disabled");
                                } else {
                                    $("[name='lama']").removeAttr("style")
                                    $(".over-cuti").html("")
                                    $(".btn-simpan-cuti").removeAttr("disabled");
                                }
                            }
                            $("[name='lama']").val(total_cuti + " Hari");
                        } else {
                            const total_cuti = Number(tanggal_sampai) - Number(tanggal_mulai)
                            if (total_cuti > 12) {
                                $("[name='lama']").attr("style", "border: 1px solid red;")
                                $(".over-cuti").html("Masa cuti maksimal 12 hari dalam 1 tahun !")
                                $(".btn-simpan-cuti").attr("disabled", "disabled");
                            } else {
                                if (total_cuti < 0) {
                                    $("[name='lama']").attr("style", "border: 1px solid red;")
                                    $(".over-cuti").html("Format tanggal cuti salah !")
                                    $(".btn-simpan-cuti").attr("disabled", "disabled");
                                } else {
                                    $("[name='lama']").removeAttr("style")
                                    $(".over-cuti").html("")
                                    $(".btn-simpan-cuti").removeAttr("disabled");
                                }
                            }
                            $("[name='lama']").val(total_cuti + " Hari");
                        }

                    });
                });
                break;
            case "Cuti Hamil":
                $("[name='tgl_sampai']").attr("readonly", "readonly");
                $("[name='tgl_mulai']").val("");
                $("[name='tgl_sampai']").val("");
                $("[name='lama']").val("");
                $("[name='lama']").removeAttr("style")
                $(".over-cuti").html("")
                $(".btn-simpan-cuti").removeAttr("disabled");

                $("[name='tgl_mulai']").change(function() {
                    const tgl = $(this).val();
                    const tgl_mulai = new Date(tgl);
                    // console.log(tgl_mulai.toLocaleDateString());
                    tgl_mulai.setMonth(tgl_mulai.getMonth() + 3);
                    $("[name='tgl_sampai']").val(tgl_mulai.toLocaleDateString())

                    const bulan_mulai = tgl.split("/");
                    // const add_nol = "0" + tgl_mulai.toLocaleDateString();
                    // const bulan_sampai = add_nol.split("/");
                    console.log();
                    if (tgl_mulai.toLocaleDateString().split("/")[0].length == 1) {
                        $("[name='lama']").val(Number("0" + tgl_mulai.toLocaleDateString().split("/")[0]) - Number(bulan_mulai[0]) + " Bulan");
                    } else {
                        $("[name='lama']").val(Number(tgl_mulai.toLocaleDateString().split("/")[0]) - Number(bulan_mulai[0]) + " Bulan");
                    }
                });
                break;
            default:
                $("[name='tgl_mulai']").val("<?= $cuti_by_id['tgl_mulai'] ?>");
                $("[name='tgl_sampai']").val("<?= $cuti_by_id['tgl_sampai'] ?>");
                $("[name='lama']").val("<?= $cuti_by_id['lama'] ?>");
                break;
        }
    });
</script>