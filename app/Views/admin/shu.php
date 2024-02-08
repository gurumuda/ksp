<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Sisa Hasil Usaha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item active">SHU Anggota</li>
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
                            <h3 class="card-title">Informasi SHU tahun <?= $tahun; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table style="width: 100%;">
                                        <tr>
                                            <th style="width: 40%;">Modal Anggota</th>
                                            <th style="width: 20px;">:</th>
                                            <td><?= number_format($totalModal, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pendapatan Jasa</th>
                                            <th>:</th>
                                            <td><?= number_format($totalJasa, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Beban</th>
                                            <th>:</th>
                                            <td><?= number_format($totalBeban, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>SHU Dibagi</th>
                                            <th>:</th>
                                            <td><?= number_format($shuDibagi, 0, ',', '.'); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table style="width: 100%;">
                                        <tr>
                                            <th style="width: 40%;">Persentase SHU Modal</th>
                                            <th style="width: 20px;">:</th>
                                            <td><?= number_format($persenModal, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Persentase SHU Jasa</th>
                                            <th>:</th>
                                            <td><?= number_format($persenJasa, 0, ',', '.'); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data SHU Anggota tahun <?= $tahun; ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-xs btn-outline-info"><i class="fas fa-print"></i> Print Data</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover table-sm mt-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Modal</th>
                                        <th>SHU Modal</th>
                                        <th>Jasa Pinjaman</th>
                                        <th>SHU Jasa</th>
                                        <th>SHU Diterima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($shu as $key) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $key['nama_anggota']; ?></td>
                                            <td class="text-right pr-2"><?= number_format($key['modal'], 0, ',', '.'); ?></td>
                                            <td class="text-right pr-2"><?= number_format($key['shuModal'], 0, ',', '.'); ?></td>
                                            <td class="text-right pr-2"><?= number_format($key['jasa'], 0, ',', '.'); ?></td>
                                            <td class="text-right pr-2"><?= number_format($key['shuJasa'], 0, ',', '.'); ?></td>
                                            <td class="text-right pr-2"><?= number_format($key['shuDiterima'], 0, ',', '.'); ?></td>

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

<?= $this->endSection() ?>