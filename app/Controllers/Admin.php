<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


class Admin extends BaseController
{

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
        $data = [
            'anggota' => $this->anggota->orderBy('nama', 'ASC')->findAll()
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
        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        $jenistransaksi = $this->jenistr->where(['periode_trx !=' => 1, 'jenis_trx' => 1])->findAll();
        $data = [
            'anggota' => $this->anggota->orderBy('nama', 'ASC')->findAll(),
            'bulan' => $bulan,
            'jenistransaksi' => $jenistransaksi
        ];
        return view('admin/debet', $data);
    }
}
