<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


class Ambil extends BaseController
{


    public function anggota()
    {
        $anggota_id = $this->request->getPost('id');

        $data = $this->anggota->where('anggota_id', $anggota_id)->first();

        echo json_encode($data);
    }

    public function jenistransaksi()
    {
        $jenistransaksi_id = $this->request->getPost('id');

        $data = $this->jenistr->where('jenistransaksi_id', $jenistransaksi_id)->first();

        echo json_encode($data);
    }

    public function transaksiDebet()
    {
        $anggota_id = $this->request->getPost('anggota_id');

        $dataAnggota = $this->anggota->select('anggota_id, nama, no_hp, alamat')->where('anggota_id', $anggota_id)->first();

        $result = [
            'dataAnggota' => $dataAnggota,
        ];

        echo json_encode($result);
    }
}
