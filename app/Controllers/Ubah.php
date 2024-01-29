<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Ubah extends BaseController
{
    public function anggota()
    {
        $anggota_id = $this->request->getPost('id_anggota');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $tmp_lahir = $this->request->getPost('tmp_lahir');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $alamat = $this->request->getPost('alamat');
        $no_hp = $this->request->getPost('no_hp');

        if ($password) {
            $data = [
                'anggota_id' => $anggota_id,
                'username' => $username,
                'password' => password_hash((string)$password, PASSWORD_DEFAULT),
                'nama' => $nama,
                'tmp_lahir' => $tmp_lahir,
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
            ];
        } else {

            $data = [
                'anggota_id' => $anggota_id,
                'username' => $username,
                'nama' => $nama,
                'tmp_lahir' => $tmp_lahir,
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
            ];
        }

        $cek = $this->anggota->where(['anggota_id !=' => $anggota_id, 'username' => $username])->first();
        if (!$cek) {
            $simpan = $this->anggota->save($data);
            if ($simpan) {
                return '1';
            }
            return '0';
        }
        return '2';
    }

    public function jenistransaksi()
    {
        $jenistransaksi_id = $this->request->getPost('jenistransaksi_id');
        $kode_trx = $this->request->getPost('kode_trx');
        $nama_trx = $this->request->getPost('nama_trx');
        $jenis_trx = $this->request->getPost('jenis_trx');
        $nominal_trx = $this->request->getPost('nominal_trx');

        $data = [
            'jenistransaksi_id' => $jenistransaksi_id,
            'kode_trx' => $kode_trx,
            'nama_trx' => $nama_trx,
            'jenis_trx' => $jenis_trx,
            'nominal_trx' => $nominal_trx,
        ];

        $cek = $this->jenistr->where(['jenistransaksi_id !=' => $jenistransaksi_id, 'kode_trx' => $kode_trx])->first();
        if (!$cek) {
            $simpan = $this->jenistr->save($data);
            if ($simpan) {
                return '1';
            }
            return '0';
        }
        return '2';
    }
}
