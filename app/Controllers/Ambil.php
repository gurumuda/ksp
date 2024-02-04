<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


class Ambil extends BaseController
{


    public function anggota()
    {
        $anggota_id = $this->request->getPost('id');

        $data = $this->anggota->where('anggota_id', $anggota_id)->first();

        echo json_encode($data);
    }

    public function jenistransaksi()
    {
        $jenistransaksi_id = $this->request->getPost('id');

        $data = $this->jenistr->where('jenistransaksi_id', $jenistransaksi_id)->first();

        echo json_encode($data);
    }

    public function transaksiDebet()
    {
        $anggota_id = $this->request->getPost('anggota_id');
        $dataAnggota = $this->anggota->select('anggota_id, nama, no_hp, alamat')->where('anggota_id', $anggota_id)->first();

        $adaPinjaman = $this->pinjaman
            ->select('pinjaman_id, anggota_id, nominal_pinjaman, lama_pinjaman, tanggal_pinjaman')
            ->where('pinjaman.anggota_id', $anggota_id)
            ->findAll();
        $statusPinjaman = [];
        foreach ($adaPinjaman as $value) {
            $terbayar = $this->transaksi
                ->select('sum(transaksi.nominal) as terbayar, count(transaksi.nominal) as pembayaran_ke,  MAX(trx_bulan) as trx_bulan, MAX(trx_tahun) as trx_tahun')
                ->join('pinjaman', 'pinjaman.pinjaman_id = transaksi.pinjaman_id', 'RIGHT')
                ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
                ->where('transaksi.anggota_id', $anggota_id)
                ->where('transaksi.pinjaman_id', $value->pinjaman_id)
                ->where('jenistransaksi.jenis_trx', 1)
                ->first();

            if ($value->nominal_pinjaman > $terbayar->terbayar) {
                $lunas = 0;
                $sisa = $value->nominal_pinjaman - $terbayar->terbayar;
            } elseif ($value->nominal_pinjaman == $terbayar->terbayar) {
                $lunas = 1;
                $sisa = $value->nominal_pinjaman - $terbayar->terbayar;
            } elseif ($value->nominal_pinjaman < $terbayar->terbayar) {
                $lunas = 2;
                $sisa = $terbayar->terbayar - $value->nominal_pinjaman;
            }

            if ($terbayar->terbayar == null) {
                $dibayar = 0;
            } else {
                $dibayar = $terbayar->terbayar;
            }

            $statusPinjaman[] = [
                'anggota_id' => $value->anggota_id,
                'pinjaman_id' => $value->pinjaman_id,
                'tanggal_pinjaman' => $value->tanggal_pinjaman,
                'lama_pinjaman' => $value->lama_pinjaman,
                'nominal_pinjaman' => $value->nominal_pinjaman,
                'dibayar' => $dibayar,
                'sisa' => $sisa,
                'pembayaran_ke' => $terbayar->pembayaran_ke,
                'lunas' => $lunas,
                'trx_bulan' => $terbayar->trx_bulan,
                'trx_tahun' => $terbayar->trx_tahun,
            ];
        }

        $formbayar = '';
        $formBayarHutang = '';
        if ($statusPinjaman) {
            # code...
            $formbayar .= '<div class="form-group row mb-2">
                        <label for="tanggal_trx" class="col-12 col-md-4">Angsuran untuk</label>
                        <div class="form-input col-12 col-md-8">
                            <select class="form-control" name="pinjaman_id" id="pinjaman_id">';
        }
        $blmLunas = [];
        $html = '';
        if ($statusPinjaman) {
            foreach ($statusPinjaman as $key) {
                if ($key['sisa'] != 0) {
                    $blmLunas[] = 'a';
                    $html .= '<table style="width: 100%; border-top: 1px dotted #808080; margin-bottom: 10px">
                        <tr>
                            <th style="vertical-align: top; width:160px">Jumlah Pinjaman</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . number_format($key['nominal_pinjaman'], 0, ',', '.') . '</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Tanggal Pinjam</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . tglIndo($key['tanggal_pinjaman']) . '</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Lama Pinjaman</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . $key['lama_pinjaman'] . ' bulan</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Telah Bayar Ke</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . $key['pembayaran_ke'] . ' bulan</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Sisa Pinjaman</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . number_format($key['sisa'], 0, ',', '.') . '</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Terakhir Bayar Bulan</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . $key['trx_bulan'] . ' - ' . $key['trx_tahun'] . '</td>
                        </tr>';
                    $html .= '</table>';

                    $formbayar .= '<option value="' . $key['pinjaman_id'] . '">' . $key['nominal_pinjaman'] . '</option>';
                }
            }

            $formbayar .= '</select>
                    </div>
                </div>';
        }
        if (in_array('a', $blmLunas)) {
            # code...
            $formBayarHutang .= '<div class="form-group row mb-2">
                        <label for="nominalbayarhutang" class="col-12 col-md-4">Bayar Pokok</label>
                        <div class="form-input col-12 col-md-8">
                            <input type="number" name="nominalbayarhutang" id="nominalbayarhutang" class="form-control" placeholder="nominal pokok">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nominaljasa" class="col-12 col-md-4">Bayar Jasa</label>
                        <div class="form-input col-12 col-md-8">
                            <input type="number" name="nominaljasa" id="nominaljasa" class="form-control" placeholder="nominal jasa">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pelunasan" class="col-12 col-md-4">Pelunasan Pinjaman</label>
                        <div class="form-input col-12 col-md-8">
                            <input type="number" name="pelunasan" id="pelunasan" class="form-control" placeholder="nominal pelunasan">
                        </div>
                    </div>';
        }

        // Akhir data pinjaman 

        // Data transaksi
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
        $pilihanbln = '';
        foreach ($bulan as $key => $bln) {
            if (date('m') == $key) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $pilihanbln .= '<option ' . $select . ' value="' . $key . '">' . $bln . '</option>';
        }

        $jenistransaksi = $this->jenistr
            ->where('periode_trx !=', 1)
            ->where('jenis_trx', 1)
            ->notLike('nama_trx', 'pinjam')
            ->notLike('nama_trx', 'hutang')
            ->findAll();

        $jns_trx = '';
        foreach ($jenistransaksi as $jenistr) :
            if ($jenistr->nominal_trx != 0) {
                $nilai = $jenistr->nominal_trx;
            } else {
                $nilai = '';
            }

            $jns_trx .= '<div class="form-group row mb-2">
                <label for="trx_' . $jenistr->jenistransaksi_id . '" class="col-12 col-md-4">' . $jenistr->nama_trx . '</label>
                <div class="form-input col-12 col-md-8">
                    <input type="number" name="trx_' . $jenistr->jenistransaksi_id . '" id="trx_' . $jenistr->jenistransaksi_id . '" class="form-control" value="' . $nilai . '">
                </div>
            </div>';
        endforeach;

        $html2 = '<input type="hidden" name="anggota_id" value="' . $anggota_id . '" style="display: none;">
        <div class="card-body">
            <div class="form-group row mb-2">
                <label for="tanggal_trx" class="col-12 col-md-4">Tanggal Transaksi</label>
                <div class="form-input col-12 col-md-8">
                    <input type="date" name="tanggal_trx" id="tanggal_trx" class="form-control" value="' . date("Y-m-d") . '">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="bulan_trx" class="col-12 col-md-4">Transaksi Bulan</label>
                <div class="form-input col-12 col-md-8">
                    <select name="bulan_trx" id="bulan_trx" class="form-control select2">
                        <option value="">--Pilih bulan--</option>';
        $html2 .= $pilihanbln;
        $html2 .= '</select>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="tahun_trx" class="col-12 col-md-4">Transaksi Tahun</label>
                <div class="form-input col-12 col-md-8">
                    <input type="number" name="tahun_trx" id="tahun_trx" class="form-control" value="' . date('Y') . '">
                </div>
            </div>';
        $html2 .= $jns_trx;
        // $html2 .= $formbayar;
        // $html2 .= $formBayarHutang;
        if (in_array('a', $blmLunas)) {
            $html2 .= $formbayar;
            $html2 .= $formBayarHutang;
        }
        $html2 .= '</div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Simpan Data Transaksi</button>
        </div>';

        $result = [
            'dataAnggota' => $dataAnggota,
            'statusPinjaman' => $statusPinjaman,
            'html' => $html,
            'html2' => $html2,
            'blm' => $blmLunas
        ];

        echo json_encode($result);
    }

    public function transaksiKredit()
    {
        $anggota_id = $this->request->getPost('anggota_id');
        $dataAnggota = $this->anggota->select('anggota_id, nama, no_hp, alamat')->where('anggota_id', $anggota_id)->first();

        $adaPinjaman = $this->pinjaman
            ->select('pinjaman_id, anggota_id, nominal_pinjaman, lama_pinjaman, tanggal_pinjaman')
            ->where('pinjaman.anggota_id', $anggota_id)
            ->findAll();
        $statusPinjaman = [];
        foreach ($adaPinjaman as $value) {
            $terbayar = $this->transaksi
                ->select('sum(transaksi.nominal) as terbayar, count(transaksi.nominal) as pembayaran_ke,  MAX(trx_bulan) as trx_bulan, MAX(trx_tahun) as trx_tahun')
                ->join('pinjaman', 'pinjaman.pinjaman_id = transaksi.pinjaman_id', 'RIGHT')
                ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
                ->where('transaksi.anggota_id', $anggota_id)
                ->where('transaksi.pinjaman_id', $value->pinjaman_id)
                ->where('jenistransaksi.jenis_trx', 1)
                ->first();

            if ($value->nominal_pinjaman > $terbayar->terbayar) {
                $lunas = 0;
                $sisa = $value->nominal_pinjaman - $terbayar->terbayar;
            } elseif ($value->nominal_pinjaman == $terbayar->terbayar) {
                $lunas = 1;
                $sisa = $value->nominal_pinjaman - $terbayar->terbayar;
            } elseif ($value->nominal_pinjaman < $terbayar->terbayar) {
                $lunas = 2;
                $sisa = $terbayar->terbayar - $value->nominal_pinjaman;
            }

            if ($terbayar->terbayar == null) {
                $dibayar = 0;
            } else {
                $dibayar = $terbayar->terbayar;
            }

            $statusPinjaman[] = [
                'anggota_id' => $value->anggota_id,
                'pinjaman_id' => $value->pinjaman_id,
                'tanggal_pinjaman' => $value->tanggal_pinjaman,
                'lama_pinjaman' => $value->lama_pinjaman,
                'nominal_pinjaman' => $value->nominal_pinjaman,
                'dibayar' => $dibayar,
                'sisa' => $sisa,
                'pembayaran_ke' => $terbayar->pembayaran_ke,
                'lunas' => $lunas,
                'trx_bulan' => $terbayar->trx_bulan,
                'trx_tahun' => $terbayar->trx_tahun,
            ];
        }

        $blmLunas = [];
        $html = '';
        if ($statusPinjaman) {
            foreach ($statusPinjaman as $key) {
                $blmLunas[] = [
                    $key['lunas'],
                ];
                if ($key['sisa'] != 0) {
                    $html .= '<table style="width: 100%; border-top: 1px dotted #808080; margin-bottom: 10px">
                        <tr>
                            <th style="vertical-align: top; width:160px">Jumlah Pinjaman</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . number_format($key['nominal_pinjaman'], 0, ',', '.') . '</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Tanggal Pinjam</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . tglIndo($key['tanggal_pinjaman']) . '</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Lama Pinjaman</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . $key['lama_pinjaman'] . ' bulan</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Telah Bayar Ke</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . $key['pembayaran_ke'] . ' bulan</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Sisa Pinjaman</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . number_format($key['sisa'], 0, ',', '.') . '</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: top; width:160px">Terakhir Bayar Bulan</th>
                            <td style="vertical-align: top; width: 20px;">:</td>
                            <td style="vertical-align: top">' . $key['trx_bulan'] . ' - ' . $key['trx_tahun'] . '</td>
                        </tr>';
                    $html .= '</table>';
                }
            }
        }
        // Akhir data pinjaman 

        // Data transaksi
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
        $pilihanbln = '';
        foreach ($bulan as $key => $bln) {
            if (date('m') == $key) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $pilihanbln .= '<option ' . $select . ' value="' . $key . '">' . $bln . '</option>';
        }

        $jenistransaksi = $this->jenistr
            ->where('periode_trx !=', 1)
            ->where('jenis_trx', 2)
            ->like('nama_trx', 'pinjam')
            ->orLike('nama_trx', 'hutang')
            ->findAll();

        $jns_trx = '';
        foreach ($jenistransaksi as $jenistr) :
            if ($jenistr->nominal_trx != 0) {
                $nilai = $jenistr->nominal_trx;
            } else {
                $nilai = '';
            }

            $jns_trx .= '<div class="form-group row mb-2">
                <label for="trx_' . $jenistr->jenistransaksi_id . '" class="col-12 col-md-4">' . $jenistr->nama_trx . '</label>
                <div class="form-input col-12 col-md-8">
                    <input type="number" name="trx_' . $jenistr->jenistransaksi_id . '" id="trx_' . $jenistr->jenistransaksi_id . '" class="form-control" value="' . $nilai . '">
                </div>
            </div>';
        endforeach;
        $jns_trx .= '<div class="form-group row mb-2">
                        <label for="lama_pinjaman" class="col-12 col-md-4">Lama Pinjaman</label>
                        <div class="form-input col-12 col-md-8">
                            <input type="number" name="lama_pinjaman" id="lama_pinjaman" class="form-control" placeholder="lama pinjaman (bulan)">
                        </div>
                    </div>';


        $html2 = '<input type="hidden" name="anggota_id" value="' . $anggota_id . '" style="display: none;">
        <div class="card-body">
            <div class="form-group row mb-2">
                <label for="tanggal_trx" class="col-12 col-md-4">Tanggal Transaksi</label>
                <div class="form-input col-12 col-md-8">
                    <input type="date" name="tanggal_trx" id="tanggal_trx" class="form-control" value="' . date("Y-m-d") . '">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="bulan_trx" class="col-12 col-md-4">Transaksi Bulan</label>
                <div class="form-input col-12 col-md-8">
                    <select name="bulan_trx" id="bulan_trx" class="form-control select2">
                        <option value="">--Pilih bulan--</option>';
        $html2 .= $pilihanbln;
        $html2 .= '</select>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="tahun_trx" class="col-12 col-md-4">Transaksi Tahun</label>
                <div class="form-input col-12 col-md-8">
                    <input type="number" name="tahun_trx" id="tahun_trx" class="form-control" value="' . date('Y') . '">
                </div>
            </div>';
        $html2 .= $jns_trx;

        $html2 .= '</div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Simpan Data Transaksi</button>
        </div>';

        $result = [
            'dataAnggota' => $dataAnggota,
            'statusPinjaman' => $statusPinjaman,
            'html' => $html,
            'html2' => $html2
        ];

        echo json_encode($result);
    }
}
