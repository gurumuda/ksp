<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Debet</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Debet</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Anggota</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="dataAnggotaKoperasi" class="col-12 col-sm-3">Pilih</label>
                                <div class="form-input col-12 col-sm-9">
                                    <select name="dataAnggotaKoperasi" id="dataAnggotaKoperasi" class="form-control select2" style="width: 100%;">
                                        <option value="">-- Pilih Nama Anggota --</option>
                                        <?php foreach ($anggota as $agt) : ?>
                                            <option value="<?= $agt->anggota_id; ?>"><?= $agt->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 mt-2 pl-3 pb-3 pr-3" id="tampil-data-anggota" style="display: none; border-top: 1px solid #D7D7D7">
                            <h5 class="text-center">Data Anggota</h5>
                            <table style="width: 100%;">
                                <tr>
                                    <th style="vertical-align: top; width:90px">Nama</th>
                                    <td style="vertical-align: top; width: 20px;">:</td>
                                    <td style="vertical-align: top"><span id="tampil-nama"></span></td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top; width:90px">No HP</th>
                                    <td style="vertical-align: top; width: 20px;">:</td>
                                    <td style="vertical-align: top"><span id="tampil-no_hp"></span></td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top; width:90px">Alamat</th>
                                    <td style="vertical-align: top; width: 20px;">:</td>
                                    <td style="vertical-align: top"><span id="tampil-alamat"></span></td>
                                </tr>
                            </table>
                            <div class="mt-4" id="data_pinjaman">

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <?= form_open('/tambah/trx_debet'); ?>
                        <div id="tampil_transaksi">

                        </div>
                        <?= form_close(); ?>
                    </div>
                    <!-- /.card -->

                </div>
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