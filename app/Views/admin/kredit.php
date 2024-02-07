<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kredit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Kredit</li>
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
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data Anggota</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="dtAnggotaKoperasi" class="col-12 col-sm-3">Pilih</label>
                                <div class="form-input col-12 col-sm-9">
                                    <select name="dtAnggotaKoperasi" id="dtAnggotaKoperasi" class="form-control select2" style="width: 100%;">
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
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <?= form_open('/tambah/trx_kredit'); ?>
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

<?= $this->endSection() ?>