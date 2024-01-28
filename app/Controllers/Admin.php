<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\Anggota;
use App\Models\Jenistransaksi;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->anggota = new Anggota();
        $this->jenistr = new Jenistransaksi();
    }

    public function index()
    {
        return view('admin/anggota');
    }

    public function koperasi()
    {
        return view('admin/anggota');
    }

    public function anggota()
    {
        helper('All_helper');

        $data = [
            'anggota' => $this->anggota->findAll()
        ];
        return view('admin/anggota', $data);
    }

    public function download($file)
    {
        $data = './format-import/' . $file . '.xlsx';
        return $this->response->download($data, null);
    }

    public function jenistransaksi()
    {
        $data = [
            'jenis_tr' => $this->jenistr->findAll()
        ];
        return view('admin/data-transaksi', $data);
    }
}
