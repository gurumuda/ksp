<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item active">Anggota</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Anggota Koperasi</h3>
                            <div class="card-tools">
                                <button type="button" data-toggle="modal" data-target="#modal-tambah" class="btn btn-xs btn-outline-info"><i class="fas fa-plus"></i> Tambah Data</button>
                                <button type="button" class="btn btn-xs btn-outline-success"><i class="fas fa-upload"></i> Import Data</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="flex">
                                <input id="filter-value" class="col-6 col-lg-3" type="text" placeholder="Pencarian ...">
                            </div>
                            <table id="example2" class="table table-bordered table-hover table-sm mt-1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>HP</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($anggota as $agt) : ?>
                                        <tr>
                                            <td><?= $agt->nama; ?></td>
                                            <td><?= jk($agt->jenis_kelamin); ?></td>
                                            <td><?= $agt->alamat; ?></td>
                                            <td><?= $agt->no_hp; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-1">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="username" placeholder="Email as username">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Anggota</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="tmp_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tmp_lahir" placeholder="Tempat Lahir">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-9">
                        <textarea name="alamat" id="alamat" class="form-control" rows="2" placeholder="Alamat Lengkap Anggota"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP/WA</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="no_hp" placeholder="Nomor HP">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection() ?>