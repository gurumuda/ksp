<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan BKU</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item active">BKU</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Buku Kas Umum</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">

                                <table class="table tbl-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Transaksi</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Saldo Awal Bulan</td>
                                            <td></td>
                                            <td></td>
                                            <td><?= number_format($saldoA, 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php $no = 1;

                                        foreach ($transaksi as $tr) : ?>
                                            <?php

                                            if ($tr->jenis_trx == 1) {
                                                # uang masuk
                                                $ket = 'Diterima dari ';
                                                $ket2 = ' untuk ';
                                                $debet = $tr->nominal;
                                                $kredit = '';
                                            } elseif ($tr->jenis_trx == 2) {
                                                # uang keluar
                                                $ket = 'Dibayarkan kepada ';
                                                $ket2 = ' untuk ';
                                                $debet = '';
                                                $kredit = $tr->nominal;
                                            }; ?>

                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= tglIndo($tr->tanggal_trx); ?></td>
                                                <td><?= $ket . $tr->nama . '<br>' . $ket2 . $tr->nama_trx; ?></td>
                                                <td><?= ($debet) ? number_format($tr->nominal, 0, ',', '.') : ''; ?></td>
                                                <td><?= ($kredit) ? number_format($tr->nominal, 0, ',', '.') : ''; ?></td>
                                                <td>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Saldo Akhir Bulan</td>
                                            <td></td>
                                            <td></td>
                                            <td><?= number_format($saldoB, 0, ',', '.'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>