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
        if ($awal) {
            $saldoA = $kas + $masukA - $keluarA;
            # code...
        } else {
            # code...
            $saldoA = $kas;
        }

        $saldoB = $saldoA + $masukB - $keluarB;

        // dd($keluarA);

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

    public function beban()
    {
        $data = [
            'beban' => $this->transaksi
                ->select('*, beban.beban_id as beban_id')
                ->join('beban', 'beban.beban_id = transaksi.beban_id', 'LEFT')
                ->where('transaksi.beban_id !=', 0)
                ->orderBy('transaksi.tanggal_trx', 'ASC')->findAll()
        ];
        return view('admin/beban', $data);
    }
}
