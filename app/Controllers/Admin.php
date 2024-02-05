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

    public function bku()
    {
        $koperasi = new Koperasi();
        $transaksi = $this->transaksi
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->join('anggota', 'anggota.anggota_id = transaksi.anggota_id', 'LEFT')
            ->where('MONTH(tanggal_trx)', 02)
            ->orderBy('transaksi.tanggal_trx', 'ASC')
            ->orderBy('transaksi.transaksi_id', 'ASC')
            ->findAll();

        $keluarA = $this->transaksi
            ->select('SUM(nominal) as keluar')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 2)
            ->where('tanggal_trx <', '2024-02-01')
            ->first()->keluar;
        $masukA = $this->transaksi
            ->select('SUM(nominal) as masuk')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 1)
            ->where('tanggal_trx <', '2024-02-01')
            ->first()->masuk;

        $keluarB = $this->transaksi
            ->select('SUM(nominal) as keluar')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 2)
            ->where('tanggal_trx <', '2024-03-01')
            ->first()->keluar;
        $masukB = $this->transaksi
            ->select('SUM(nominal) as masuk')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 1)
            ->where('tanggal_trx <', '2024-03-01')
            ->first()->masuk;

        $kas = $koperasi->first()->kas;
        $saldoA = $kas + $masukA - $keluarA;
        $saldoB = $kas + $masukB - $keluarB;
        $data = [
            'koperasi' => $koperasi->first(),
            'transaksi' => $transaksi,
            'saldoA' => $saldoA,
            'saldoB' => $saldoB
        ];
        return view('admin/bku', $data);
    }
}
