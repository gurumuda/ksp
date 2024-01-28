<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Anggota;

class Ambil extends BaseController
{
    public function __construct()
    {
        $this->anggota = new Anggota();
    }

    public function anggota()
    {
        $anggota_id = $this->request->getPost('id');

        $data = $this->anggota->where('anggota_id', $anggota_id)->first();

        echo json_encode($data);
    }
}
