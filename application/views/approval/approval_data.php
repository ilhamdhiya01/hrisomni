<section class="content-header">
    <h1>Approval Cuti
        <small>Menunggu Approval</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-calendar"></i> </a></li>
        <li class="active">Menunggu Approval</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Menunggu Approval</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr class="text-sm">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Keperluan Cuti</th>
                        <th>Lama Cuti</th>
                        <th>Mulai tgl</th>
                        <th>Sampai tgl</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_cuti as $cuti) :
                    ?>
                        <tr class="text-sm">
                            <?php
                            // $this->db->select('created_at,user_id');
                            // $this->db->from('pengajuan_cuti');
                            // $this->db->where('user_id', $cuti['user_id']);
                            // $this->db->where('created_at',date('d-m-Y'));
                            // $result = $this->db->get_where('pengajuan_cuti', ['created_at' => date('d-m-Y')])->row_array();
                            // var_dump($result);
                            if ($cuti['created_at'] == date('d-m-Y')) :
                            ?>
                                <td class="text-bold"><?= $no++ . ' <span class="label label-danger"> New</span>'; ?></td>
                            <?php else : ?>
                                <td class="text-bold"><?= $no++; ?></td>
                            <?php endif; ?>
                            <td><?= $cuti['nama_pegawai']; ?></td>
                            <td><?= $cuti['divisi_d']; ?></td>
                            <td><?= $cuti['keperluan']; ?></td>
                            <td><?= $cuti['lama']; ?></td>
                            <td><?= $cuti['tgl_mulai']; ?></td>
                            <td><?= $cuti['tgl_sampai']; ?></td>
                            <td><?= $cuti['keterangan']; ?></td>
                            <td>
                                <select class="form-control form-control-sm w-3 status" data-userid="<?= $cuti['user_id']; ?>" data-id="<?= $cuti['id']; ?>">
                                    <option>Status</option>
                                    <?php if ($cuti['status'] == 1) : ?>
                                        <option value="1" selected>Setujui</option>
                                        <option value="2">Menunggu</option>
                                        <option value="0">Tolak</option>
                                    <?php elseif ($cuti['status'] == 0) : ?>
                                        <option value="1">Setujui</option>
                                        <option value="2">Menunggu</option>
                                        <option value="0" selected>Tolak</option>
                                    <?php else : ?>
                                        <option value="1">Setujui</option>
                                        <option value="2" selected>Menunggu</option>
                                        <option value="0">Tolak</option>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td class="text-center" width="160px">
                                <?php if ($this->session->userdata('id_user') == $cuti['user_id']) : ?>
                                    <a href="<?= site_url() ?>approval/edit/<?= $cuti['id']; ?>" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil"></i> Update
                                    </a>
                                    <a href="<?= site_url() ?>approval/del/<?= $cuti['id']; ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                <?php elseif ($this->session->userdata('level_id') == 1) : ?>
                                    <a href="<?= site_url() ?>approval/edit/<?= $cuti['id']; ?>" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil"></i> Update
                                    </a>
                                    <a href="<?= site_url() ?>approval/del/<?= $cuti['id']; ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</section>

<script>
    $(".status").change(function() {
        const id_cuti = $(this).data("id");
        console.log($(this).val())
        switch ($(this).val()) {
            case "1":
            case "2":
            case "0":
                $.ajax({
                    url: "<?= base_url(); ?>tunggu/ubah_status",
                    type: "post",
                    dataType: "json",
                    data: {
                        id_cuti: id_cuti,
                        user_id: $(this).data("userid"),
                        status: $(this).val()
                    },
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
                        }
                    }
                });
                break;
            default:
                break;
        }
    });
</script>