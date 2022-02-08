<section class="content-header">
    <h1>History Cuti
        <small>Daftar Cuti</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-history"></i> </a></li>
        <li><a href="#">Cuti</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Cuti</h3>

        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Keperluan Cuti</th>
                        <th>Lama Cuti</th>
                        <th>Mulai tgl</th>
                        <th>Sampai tgl</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($row->result() as $key => $data) { ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $data->id_nama ?></td>
                            <td><?= $data->id_divisi ?></td>
                            <td><?= $data->keperluan ?></td>
                            <td><?= $data->lama ?> <?= $data->ket_lama ?></td>
                            <td><?= $data->mulai ?></td>
                            <td><?= $data->sampai ?></td>
                            <td class="text-center" width="120px">
                                <a href="#" class="btn btn-success btn-xs "> Disetujui
                                </a>
                            </td>
                            <td class="text-center" width="160px">
                                <a href="#" class="btn btn-primary btn-xs "> 'keterangan'
                                </a>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>

            </table>
        </div>
    </div>
</section>