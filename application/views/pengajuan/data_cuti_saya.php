<section class="content-header">
    <h1>Pengajuan Cuti
        <small>Pengajuan Cuti</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-calendar"></i> </a></li>
        <li class="active">Pengajuan Cuti</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Pengajuan Cuti</h3>
            <div class="pull-right">
                <a href="<?= site_url('cuti/add') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-plus"></i> Ajukan Cuti
                </a>
            </div>
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
                            <td><?= $no++; ?></td>
                            <td><?= $cuti['nama_pegawai']; ?></td>
                            <td><?= $cuti['divisi_d']; ?></td>
                            <td><?= $cuti['keperluan']; ?></td>
                            <td><?= $cuti['lama']; ?></td>
                            <td><?= $cuti['tgl_mulai']; ?></td>
                            <td><?= $cuti['tgl_sampai']; ?></td>
                            <td><?= $cuti['keterangan']; ?></td>
                            <td>
                                <?php if ($cuti['status'] == 0) : ?>
                                    <span class="label label-danger">Ditolak</span>
                                <?php elseif ($cuti['status'] == 1) : ?>
                                    <span class="label label-success">Disetujui</span>
                                <?php else : ?>
                                    <span class="label label-warning">Menunggu</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center" width="160px">
                                <?php if ($this->session->userdata('level_id') == 1) : ?>
                                    <a href="<?= site_url() ?>cuti/edit/<?= $cuti['id']; ?>" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil"></i> Update
                                    </a>
                                    <a href="<?= site_url() ?>cuti/del/<?= $cuti['id']; ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                <?php elseif ($this->session->userdata('level_id') == 2) : ?>
                                    <?php
                                    $this->db->select('status, user_id');
                                    $this->db->where('user_id', $this->session->userdata('id_user'));
                                    $this->db->where('id', $cuti['id']);
                                    $cek_notif = $this->db->get('pengajuan_cuti')->row_array();
                                    if ($cek_notif['status'] == 1 || $cek_notif['status'] == 0) :
                                    ?>
                                    <?php else : ?>
                                        <a href="<?= site_url() ?>cuti/edit/<?= $cuti['id']; ?>" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil"></i> Update
                                        </a>
                                    <?php endif; ?>
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