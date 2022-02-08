<section class="content-header">
    <h1>Departemen
        <small>Data Divisi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-building"></i> </a></li>
        <li><a href="#">Departemen</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Departemen</h3>
            <div class="pull-right">
                <a href="<?= site_url('divisi/add') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>

        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Divisi</th>
                        <th>Divisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($row->result() as $key => $data) { ?>
                        <tr>
                            <td style="width: 5%;"><?= $no++ ?>.</td>
                            <td><?= $data->no_divisi ?></td>
                            <td><?= $data->divisi_d ?></td>
                            <td class="text-center" width="160px">
                                <a href="<?= site_url('divisi/edit/' . $data->id_divisi) ?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <a href="<?= site_url('divisi/del/' . $data->id_divisi) ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                </form>
                            </td>

                        </tr>
                    <?php
                    } ?>
                </tbody>

            </table>
        </div>
    </div>
</section>