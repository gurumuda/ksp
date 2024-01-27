<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\Anggota;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->anggota = new Anggota();
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
}
