<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item active">Jenis Transaksi</li>
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
                            <h3 class="card-title">Data Jenis Transaksi</h3>
                            <div class="card-tools">
                                <button type="button" data-toggle="modal" data-target="#modal-tambah" class="btn btn-xs btn-outline-info"><i class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover table-sm mt-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Nama Transaksi</th>
                                        <th>Jenis Transaksi</th>
                                        <th>Periode</th>
                                        <th>Nominal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($jenis_tr as $tr) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $tr->kode_trx; ?></td>
                                            <td><?= $tr->nama_trx; ?></td>
                                            <td><?= jenistrx($tr->jenis_trx); ?></td>
                                            <td><?= periodetrx($tr->periode_trx); ?></td>
                                            <td><?= ($tr->nominal_trx != 0) ? 'Rp. ' . number_format($tr->nominal_trx, 0, ',', '.') : 'Disesuaikan'; ?></td>
                                            <td>
                                                <button data-id="<?= $tr->jenistransaksi_id; ?>" data-nama="<?= $tr->nama_trx; ?>" class="btn btn-xs btn-outline-warning btn-ubah-jenistransaksi"><i class="fas fa-edit"></i></button>
                                                <button data-id="<?= $tr->jenistransaksi_id; ?>" data-nama="<?= $tr->nama_trx; ?>" class="btn btn-xs btn-outline-danger btn-hapus-jenistransaksi"><i class="fas fa-trash"></i></button>
                                            </td>
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

<div class="modal fade reloadpage" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-1">
                    <label for="kode_trx" class="col-sm-4 col-form-label">Kode Transaksi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kode_trx" placeholder="Kode Transaksi">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="nama_trx" class="col-sm-4 col-form-label">Nama Transaksi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_trx" placeholder="Nama Transaksi">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="periode_trx" class="col-sm-4 col-form-label">Periode Transaksi</label>
                    <div class="col-sm-8">
                        <select id="periode_trx" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="1">Satu kali</option>
                            <option value="2">Bulanan</option>
                            <option value="3">Insidental (sesuai keadaan)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="jenis_trx" class="col-sm-4 col-form-label">Jenis Transaksi</label>
                    <div class="col-sm-8">
                        <select id="jenis_trx" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="1">Debet</option>
                            <option value="2">Kredit</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="nominal_trx" class="col-sm-4 col-form-label">Nominal Transaksi</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="nominal_trx" placeholder="Nominal Transaksi">
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" id="btn-tambah-jenistransaksi" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade reloadpage" id="modal-ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="jenistransaksi_id">
                <div class="form-group row mb-1">
                    <label for="ubah_kode_trx" class="col-sm-4 col-form-label">Kode Transaksi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ubah_kode_trx" placeholder="Kode Transaksi">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="ubah_nama_trx" class="col-sm-4 col-form-label">Nama Transaksi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ubah_nama_trx" placeholder="Nama Transaksi">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="ubah_periode_trx" class="col-sm-4 col-form-label">Periode Transaksi</label>
                    <div class="col-sm-8">
                        <select id="ubah_periode_trx" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="1">Satu kali</option>
                            <option value="2">Bulanan</option>
                            <option value="3">Insidental (sesuai keadaan)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="ubah_jenis_trx" class="col-sm-4 col-form-label">Jenis Transaksi</label>
                    <div class="col-sm-8">
                        <select id="ubah_jenis_trx" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="1">Debet</option>
                            <option value="2">Kredit</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="ubah_nominal_trx" class="col-sm-4 col-form-label">Nominal Transaksi</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="ubah_nominal_trx" placeholder="Nominal Transaksi">
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" id="btn-ubah-jenistransaksi" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<?= $this->endSection() ?>