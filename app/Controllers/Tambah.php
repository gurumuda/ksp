<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Tambah extends BaseController
{
    public function anggota()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $tmp_lahir = $this->request->getPost('tmp_lahir');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $alamat = $this->request->getPost('alamat');
        $no_hp = $this->request->getPost('no_hp');
        $simp_pokok = $this->request->getPost('simp_pokok');

        $data = [
            'username' => $username,
            'password' => password_hash((string)$password, PASSWORD_DEFAULT),
            'nama' => $nama,
            'tmp_lahir' => $tmp_lahir,
            'tgl_lahir' => $tgl_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'no_hp' => $no_hp,
        ];
        $cek = $this->anggota->where('username', $username)->first();
        if (!$cek) {
            # code...
            $simpan = $this->anggota->save($data);
            if ($simpan) {
                $trx = $this->jenistr->where('periode_trx', 1)->first();
                $daftar = [
                    'anggota_id' => $this->anggota->getInsertID(),
                    'jenistransaksi_id' => $trx->jenistransaksi_id,
                    'nominal' => $simp_pokok,
                    'tanggal_trx' => date('Y-m-d'),
                    'trx_bulan' => date('m'),
                    'trx_tahun' => date('Y')
                ];
                $this->transaksi->save($daftar);

                return '1';
            }
            return '0';
        }
        return '2';
    }

    public function importAnggota()
    {
        $validationRule = [
            'file' => [
                'label' => 'File',
                'rules' => [
                    'uploaded[file]',
                    'mime_in[file,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                ],
            ],
        ];
        if (!$this->validate($validationRule)) {
            $data = $this->validator->getErrors();

            session()->setFlashdata('error', $data['file']);
            return redirect()->back();
        }

        $file = $this->request->getFile('file');

        if (!$file->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $file->store();
            // $data = ['uploaded_fileinfo' => new File($filepath)];
            return $this->prosesImportAnggota($filepath);
        }
    }

    private function prosesImportAnggota($filepath)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($filepath);
        $rows = $spreadsheet->getActiveSheet()->toArray();

        for ($i = 3; $i < count($rows); $i++) {
            if ($rows[$i][6] == 'Laki-laki') {
                $jenis_kelamin = 1;
            } elseif ($rows[$i][6] == 'Perempuan') {
                $jenis_kelamin = 2;
            } else {
                $jenis_kelamin = 0;
            }

            $data = [
                'username' => $rows[$i][1],
                'password' => password_hash($rows[$i][2], PASSWORD_DEFAULT),
                'nama' => $rows[$i][3],
                'tmp_lahir' => $rows[$i][4],
                'tgl_lahir' => $rows[$i][5],
                'jenis_kelamin' => $jenis_kelamin,
                'no_hp' => $rows[$i][7],
                'alamat' => $rows[$i][8],
            ];
            $cek = $this->anggota->where('username', $rows[$i][1])->first();
            if (!$cek && $rows[$i][1] != '') {
                $this->anggota->save($data);

                $trx = $this->jenistr->where('periode_trx', 1)->first();
                $daftar = [
                    'anggota_id' => $this->anggota->getInsertID(),
                    'jenistransaksi_id' => $trx->jenistransaksi_id,
                    'nominal' => $trx->nominal_trx,
                    'tanggal_trx' => date('Y-m-d'),
                    'trx_bulan' => date('m'),
                    'trx_tahun' => date('Y')
                ];
                $this->transaksi->save($daftar);
            } else {
                session()->setFlashdata('error', 'Ada duplikasi data username');
                return redirect()->back();
            }
        }

        session()->setFlashdata('success', 'Data berhasil diimpor');
        return redirect()->back();
    }

    public function jenistransaksi()
    {
        $kode_trx = $this->request->getPost('kode_trx');
        $nama_trx = $this->request->getPost('nama_trx');
        $jenis_trx = $this->request->getPost('jenis_trx');
        $periode_trx = $this->request->getPost('periode_trx');
        $nominal_trx = $this->request->getPost('nominal_trx');

        $data = [
            'kode_trx' => $kode_trx,
            'nama_trx' => $nama_trx,
            'periode_trx' => $periode_trx,
            'jenis_trx' => $jenis_trx,
            'nominal_trx' => $nominal_trx,
        ];

        $cek = $this->jenistr->where('kode_trx', $kode_trx)->first();
        if (!$cek) {
            # code...
            $simpan = $this->jenistr->save($data);
            if ($simpan) {
                return '1';
            }
            return '0';
        }
        return '2';
    }

    public function trx_debet()
    {
        // echo '<pre>';
        // print_r($_POST);
        // die;
        $anggota_id = $this->request->getPost('anggota_id');
        $tanggal_trx = $this->request->getPost('tanggal_trx');
        $trx_bulan = $this->request->getPost('bulan_trx');
        $trx_tahun = $this->request->getPost('tahun_trx');
        $pinjaman_id = $this->request->getPost('pinjaman_id');
        $nominalbayarhutang = $this->request->getPost('nominalbayarhutang');
        $nominaljasa = $this->request->getPost('nominaljasa');
        $pelunasan = $this->request->getPost('pelunasan');

        // proses input kuajiban bulanan dan sukarela

        $jenistransaksi = $this->jenistr
            ->where('periode_trx !=', 1)
            ->where('jenis_trx', 1)
            ->findAll();
        $trx = [];
        foreach ($jenistransaksi as $jnstrx) {
            if ($this->request->getPost('trx_' . $jnstrx->jenistransaksi_id)) {
                $trx[] = [
                    'jenistransaksi_id' => $jnstrx->jenistransaksi_id,
                    'jumlah' => $this->request->getPost('trx_' . $jnstrx->jenistransaksi_id)
                ];
            }
        }

        foreach ($trx as $key) {
            $bulanan = [
                'jenis_trx' => 1,
                'anggota_id' => $anggota_id,
                'jenistransaksi_id' => $key['jenistransaksi_id'],
                'nominal' => $key['jumlah'],
                'tanggal_trx' => $tanggal_trx,
                'trx_bulan' => $trx_bulan,
                'trx_tahun' => $trx_tahun
            ];
            $this->transaksi->save($bulanan);
        }

        // proses input kuajiban hutang
        $jenistransaksihutang = $this->jenistr
            ->where('periode_trx !=', 1)
            ->where('jenis_trx', 1)
            ->like('nama_trx', 'pinjam')
            ->orlike('nama_trx', 'hutang')
            ->first();

        if ($nominalbayarhutang) {
            $byrhutang = [
                'jenis_trx' => 1,
                'anggota_id' => $anggota_id,
                'jenistransaksi_id' => $jenistransaksihutang->jenistransaksi_id,
                'pinjaman_id' => $pinjaman_id,
                'nominal' => $nominalbayarhutang,
                'tanggal_trx' => $tanggal_trx,
                'trx_bulan' => $trx_bulan,
                'trx_tahun' => $trx_tahun
            ];

            $byrjasa = [
                'jenis_trx' => 1,
                'anggota_id' => $anggota_id,
                'pinjaman_id' => $pinjaman_id,
                'nominal' => $nominaljasa,
                'tanggal_trx' => $tanggal_trx,
                'trx_bulan' => $trx_bulan,
                'trx_tahun' => $trx_tahun
            ];
            $this->transaksi->save($byrhutang);
            $this->transaksi->save($byrjasa);
        }
        $pelunasan_id = $this->jenistr
            ->where('periode_trx !=', 1)
            ->where('jenis_trx', 1)
            ->like('nama_trx', 'lunas')
            ->orlike('nama_trx', 'tutup')
            ->first()->jenistransaksi_id;

        if ($pelunasan) {
            $byrlunas = [
                'jenis_trx' => 1,
                'anggota_id' => $anggota_id,
                'jenistransaksi_id' => $pelunasan_id,
                'pinjaman_id' => $pinjaman_id,
                'nominal' => $pelunasan,
                'tanggal_trx' => $tanggal_trx,
                'trx_bulan' => $trx_bulan,
                'trx_tahun' => $trx_tahun
            ];
            $this->transaksi->save($byrlunas);
        }

        return redirect()->back();
    }

    public function trx_kredit()
    {

        $anggota_id = $this->request->getPost('anggota_id');
        $tanggal_trx = $this->request->getPost('tanggal_trx');
        $trx_bulan = $this->request->getPost('bulan_trx');
        $trx_tahun = $this->request->getPost('tahun_trx');
        $lama_pinjaman = $this->request->getPost('lama_pinjaman');

        $jenistransaksi = $this->jenistr
            ->where('periode_trx !=', 1)
            ->where('jenis_trx', 2)
            ->findAll();
        $trx = [];
        foreach ($jenistransaksi as $jnstrx) {
            if ($this->request->getPost('trx_' . $jnstrx->jenistransaksi_id)) {
                $trx[] = [
                    'jenistransaksi_id' => $jnstrx->jenistransaksi_id,
                    'jumlah' => $this->request->getPost('trx_' . $jnstrx->jenistransaksi_id)
                ];
            }
        }

        foreach ($trx as $key) {
            $dtPinjaman = [
                'anggota_id' => $anggota_id,
                'lama_pinjaman' => $lama_pinjaman,
                'nominal_pinjaman' => $key['jumlah'],
                'tanggal_pinjaman' => $tanggal_trx
            ];

            $this->pinjaman->save($dtPinjaman);

            $kredit = [
                'jenis_trx' => 2,
                'anggota_id' => $anggota_id,
                'jenistransaksi_id' => $key['jenistransaksi_id'],
                'pinjaman_id' => $this->pinjaman->getInsertID(),
                'nominal' => $key['jumlah'],
                'tanggal_trx' => $tanggal_trx,
                'trx_bulan' => $trx_bulan,
                'trx_tahun' => $trx_tahun
            ];
            $this->transaksi->save($kredit);
        }

        return redirect()->back();
    }

    public function beban()
    {
        $nama_trx = $this->request->getPost('nama_trx');
        $nominal = $this->request->getPost('nominal_trx');
        $tanggal_trx = $this->request->getPost('tanggal_trx');

        $trx_bulan = substr((string)$tanggal_trx, 5, 2);
        $trx_tahun = substr((string)$tanggal_trx, 0, 4);

        $dataBeban = [
            'nama_trx' => $nama_trx
        ];

        $this->beban->save($dataBeban);

        $dataTransaksi = [
            'jenis_trx' => 2,
            'beban_id' => $this->beban->getInsertID(),
            'nominal' => $nominal,
            'tanggal_trx' => $tanggal_trx,
            'trx_bulan' => $trx_bulan,
            'trx_tahun' => $trx_tahun
        ];

        $this->transaksi->save($dataTransaksi);

        return redirect()->back();
    }
}
