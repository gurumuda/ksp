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
        echo '<pre>';
        print_r($_POST);
    }
}
