<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Hapus extends BaseController
{

    public function anggota()
    {
        $anggota_id = $this->request->getPost('id');
        $hapus = $this->anggota->delete($anggota_id);
        if ($hapus) {
            return '1';
        }
        return '0';
    }

    public function jenistransaksi()
    {
        $jenistransaksi_id = $this->request->getPost('id');
        $hapus = $this->jenistr->delete($jenistransaksi_id);
        if ($hapus) {
            return '1';
        }
        return '0';
    }

    public function beban()
    {
        $beban_id = $this->request->getPost('id');
        $hapus = $this->beban->delete($beban_id);
        $hapustr = $this->transaksi->where('beban_id', $beban_id)->delete();
        if ($hapus) {
            return '1';
        }
        return '0';
    }
}
