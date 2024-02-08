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
                    <!-- Date range -->
                    <?= form_open('/admin/bku', ['method' => 'GET']); ?>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Tanggal Awal</label>
                                <input type="date" required name="tglMulai" id="tglMulai" class="form-control" value="<?= $tglMulai ? $tglMulai : ''; ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Tanggal Akhir</label>
                                <input type="date" required name="tglSelesai" id="tglSelesai" class="form-control" value="<?= $tglSelesai ? $tglSelesai : ''; ?>">
                            </div>
                        </div>
                        <div class="col-2 pt-1">
                            <div class="form-group pt-4">
                                <label for=""></label>
                                <button type="submit" class="btn btn-success">Tampilkan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Buku Kas Umum</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
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
                                        <td>Saldo Awal</td>
                                        <td></td>
                                        <td></td>
                                        <td><?= number_format($saldoA, 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php $no = 1;
                                    $i = 0;
                                    $saldo = [];
                                    foreach ($transaksi as $tr) : ?>
                                        <?php

                                        if ($tr->jenistransaksi_id == 0 && $tr->beban_id == 0) {
                                            $namaTransaksi = 'Jasa pinjaman';
                                        } elseif ($tr->jenistransaksi_id == 0 && $tr->beban_id != 0) {
                                            $namaTransaksi = $tr->namaBeban;
                                        } else {
                                            $namaTransaksi = $tr->nama_trx;
                                        }

                                        if ($tr->jenis_trx == 1 && $tr->beban_id == 0) {
                                            # uang masuk
                                            $ket = 'Diterima dari ';
                                            $ket2 = ' untuk ';
                                            $debet = $tr->nominal;
                                            $kredit = '';
                                            $saldo[] = $transaksi[$i]->nominal;
                                        } elseif ($tr->jenis_trx == 2 && $tr->beban_id == 0) {
                                            # uang keluar
                                            $ket = 'Dibayarkan kepada ';
                                            $ket2 = ' untuk ';
                                            $debet = '';
                                            $kredit = $tr->nominal;
                                            $saldo[] = -$transaksi[$i]->nominal;
                                        } elseif ($tr->beban_id != 0) {
                                            # uang keluar
                                            $ket = 'Dibayarkan untuk ';
                                            $ket2 = '';
                                            $debet = '';
                                            $kredit = $tr->nominal;
                                            $saldo[] = -$transaksi[$i]->nominal;
                                        }; ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= tglIndo($tr->tanggal_trx); ?></td>
                                            <td><?= $ket . $tr->nama . '<br>' . $ket2 . $namaTransaksi; ?></td>
                                            <td><?= ($debet) ? number_format($tr->nominal, 0, ',', '.') : ''; ?></td>
                                            <td><?= ($kredit) ? number_format($tr->nominal, 0, ',', '.') : ''; ?></td>
                                            <td>
                                                <?= number_format((array_sum($saldo) + $saldoA), 0, ',', '.');
                                                ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Saldo Akhir</td>
                                        <td></td>
                                        <td></td>
                                        <td><?= number_format($saldoB, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" class="btn btn-primary">
                                Cetak
                            </button>
                        </div>
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