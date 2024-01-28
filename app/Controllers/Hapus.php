<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Anggota;

class Hapus extends BaseController
{
    public function __construct()
    {
        $this->anggota = new Anggota();
    }
    public function anggota()
    {
        $anggota_id = $this->request->getPost('id');
        $hapus = $this->anggota->delete($anggota_id);
        if ($hapus) {
            return '1';
        }
        return '0';
    }
}
