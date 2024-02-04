<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Koperasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item active">Koperasi</li>
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
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Koperasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Koperasi</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama koperasi" value="<?= $koperasi->nama; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="no">Nomor Badan Hukum</label>
                                    <input type="text" class="form-control" name="no" id="no" placeholder="Masukkan no SIUP" value="<?= $koperasi->no; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Kantor</label>
                                    <textarea name="alamat" id="alamat" rows="5" class="form-control"><?= $koperasi->alamat; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kas">Kas (Rp.)</label>
                                    <input type="number" class="form-control" name="kas" id="kas" placeholder="Nominal kas per input data" value="<?= $koperasi->kas; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo" id="logo" />
                                            <label class="custom-file-label" for="logo">Choose file</label>
                                        </div>
                                    </div>
                                </div>

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

<div class="modal fade reloadpage" id="modal-tambah">
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
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select id="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-9">
                        <textarea id="alamat" class="form-control" rows="2" placeholder="Alamat Lengkap Anggota"></textarea>
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
                <button type="button" id="btn-tambah-anggota" class="btn btn-primary">Simpan Data</button>
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
                <h4 class="modal-title">Ubah Data Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_anggota">
                <div class="form-group row mb-1">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="ubah_username" placeholder="Email as username">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="ubah_password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Anggota</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ubah_nama" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="tmp_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ubah_tmp_lahir" placeholder="Tempat Lahir">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="ubah_tgl_lahir" placeholder="Tanggal Lahir">
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select id="ubah_jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-9">
                        <textarea id="ubah_alamat" class="form-control" rows="2" placeholder="Alamat Lengkap Anggota"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP/WA</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="ubah_no_hp" placeholder="Nomor HP">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" id="btn-ubah-anggota" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('/tambah/importAnggota'); ?>
            <div class="modal-body">
                <div class="form-group row pb-3" style="border-bottom: 2px solid #757575;">
                    <label class="col-6" for="">Download Format Import</label>
                    <div class="form-input col-6">
                        <a class="btn btn-sm btn-primary" href="/admin/download/Anggota">Donwload</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="customFile">Pilih File Format Import</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Import Data</button>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection() ?>