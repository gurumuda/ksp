<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Koperasi;
use CodeIgniter\HTTP\ResponseInterface;


class Admin extends BaseController
{

    public function index()
    {
        return view('admin/anggota');
    }

    public function koperasi()
    {
        $koperasi = new Koperasi();
        $data = [
            'koperasi' => $koperasi->first()
        ];
        return view('admin/koperasi', $data);
    }

    public function anggota()
    {
        $data = [
            'anggota' => $this->anggota->orderBy('nama', 'ASC')->findAll(),
            'pokok' => $this->jenistr->where('periode_trx', 1)->first()->nominal_trx
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
            'jenis_tr' => $this->jenistr->orderBy('jenis_trx', 'ASC')->findAll()
        ];
        return view('admin/data-transaksi', $data);
    }

    public function debet()
    {
        $data = [
            'anggota' => $this->anggota->orderBy('nama', 'ASC')->findAll(),
        ];
        return view('admin/debet', $data);
    }

    public function kredit()
    {
        $data = [
            'anggota' => $this->anggota->orderBy('nama', 'ASC')->findAll(),
        ];
        return view('admin/kredit', $data);
    }
}
