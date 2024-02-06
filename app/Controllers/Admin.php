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

    public function bku($awal = null, $akhir = null)
    {
        $awal = $this->request->getGet('tglMulai');
        $akhir = $this->request->getGet('tglSelesai');

        $koperasi = new Koperasi();
        $transaksi = $this->transaksi->bku($awal, $akhir)->findAll();
        $keluarA = $this->transaksi->keluarA($awal, $akhir)->first()->keluar;
        $masukA = $this->transaksi->masukA($awal, $akhir)->first()->masuk;

        $keluarB = $this->transaksi->keluarB($awal, $akhir)->first()->keluar;
        $masukB = $this->transaksi->masukB($awal, $akhir)->first()->masuk;

        $kas = $koperasi->first()->kas;
        $saldoA = $kas + $masukA - $keluarA;
        $saldoB = $kas + $masukB - $keluarB;
        $data = [
            'koperasi' => $koperasi->first(),
            'transaksi' => $transaksi,
            'saldoA' => $saldoA,
            'saldoB' => $saldoB,
            'tglMulai' => $awal,
            'tglSelesai' => $akhir

        ];
        return view('admin/bku', $data);
    }
}
