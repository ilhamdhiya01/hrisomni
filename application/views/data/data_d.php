<section class="content-header">
    <h1>Karyawan
        <small>Data Karyawan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-building"></i> </a></li>
        <li><a href="#">Data Karyawan</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Karyawan</h3>
            <div class="pull-right">
                <a href="<?= site_url('data/add') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>

        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr class="text-sm">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($karyawan as $kr) :
                    ?>
                        <tr class="text-sm">
                            <td><?= $no++; ?></td>
                            <td><?= $kr['nama_pegawai']; ?></td>
                            <td><?= $kr['tgl_masuk']; ?></td>
                            <td><?= $kr['tgl_lahir']; ?></td>
                            <td><?= $kr['tempat_lahir']; ?></td>
                            <td><?= $kr['jenis_kelamin']; ?></td>
                            <td><?= $kr['alamat']; ?></td>
                            <td><?= $kr['nohp']; ?></td>
                            <td><?= $kr['email']; ?></td>
                            <td class="text-center" width="160px">
                                <a href="<?= base_url(); ?>data/edit/<?= $kr['id']; ?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <a href="<?= site_url('data/del/') . $kr['id'];  ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</section>