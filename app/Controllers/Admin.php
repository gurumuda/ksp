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
            'tahun' => $this->koperasi->first()->tahun
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

    public function shu()
    {
        $tahun = $this->koperasi->first()->tahun;
        $anggotas = $this->transaksi
            ->join('anggota', 'anggota.anggota_id = transaksi.anggota_id', 'LEFT')
            ->where('transaksi.anggota_id !=', 0)
            ->groupBy('transaksi.anggota_id')
            ->findAll();

        $totalModal = $this->transaksi
            ->select('sum(nominal) as totalmodal')
            ->where('transaksi.jenis_trx', 1)
            ->where('jenistransaksi.nominal_trx <>', 0)
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id')
            ->first()->totalmodal;
        $totalJasa = $this->transaksi
            ->select('sum(nominal) as totalJasa')
            ->where('transaksi.jenis_trx', 1)
            ->where('transaksi.jenistransaksi_id', 0)
            ->where('transaksi.beban_id', 0)
            ->where('YEAR(tanggal_trx)', $tahun)
            ->first()->totalJasa;
        $totalBeban = $this->transaksi
            ->select('sum(nominal) as totalBeban')
            ->where('transaksi.jenis_trx', 2)
            ->where('transaksi.jenistransaksi_id', 0)
            ->where('transaksi.beban_id <>', 0)
            ->where('YEAR(tanggal_trx)', $tahun)
            ->first()->totalBeban;
        $shuDibagi = $totalJasa - $totalBeban;
        $persenModal = $shuDibagi * ($this->koperasi->first()->shu_modal) / 100;
        $persenJasa = $shuDibagi * ($this->koperasi->first()->shu_jasa) / 100;
        $data = [];
        foreach ($anggotas as $anggota) {
            $modal = $this->transaksi
                ->select('sum(nominal) as modal')
                ->where('transaksi.anggota_id', $anggota->anggota_id)
                ->where('transaksi.jenis_trx', 1)
                ->where('jenistransaksi.nominal_trx <>', 0)
                ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id')
                ->first()->modal;
            $jasa = $this->transaksi
                ->select('sum(nominal) as jasa')
                ->where('transaksi.anggota_id', $anggota->anggota_id)
                ->where('transaksi.jenis_trx', 1)
                ->where('transaksi.jenistransaksi_id', 0)
                ->where('transaksi.beban_id', 0)
                ->where('YEAR(tanggal_trx)', $tahun)
                ->first()->jasa;
            $shuModalAnggota = $modal * $persenModal / $totalModal;
            $shuJasaAnggota = $jasa * $persenJasa / $totalJasa;
            $shuDiterima = $shuModalAnggota + $shuJasaAnggota;

            $data[] = [
                'nama_anggota' => $anggota->nama,
                'modal' => $modal,
                'jasa' => $jasa,
                'shuModal' => $shuModalAnggota,
                'shuJasa' => $shuJasaAnggota,
                'shuDiterima' => $shuDiterima
            ];
        }
        $data = [
            'tahun' => $tahun,
            'shu' => $data,
            'totalModal' => $totalModal,
            'totalJasa' => $totalJasa,
            'totalBeban' => $totalBeban,
            'shuDibagi' => $shuDibagi,
            'persenModal' => $persenModal,
            'persenJasa' => $persenJasa,
        ];
        return view('admin/shu', $data);
    }
}
