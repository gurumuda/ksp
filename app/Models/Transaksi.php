<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'transaksi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function bku($awal, $akhir)
    {
        $this->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->join('anggota', 'anggota.anggota_id = transaksi.anggota_id', 'LEFT');
        if ($awal != null) {
            $this->where('tanggal_trx >=', $awal);
            $this->where('tanggal_trx <=', $akhir);
        }
        $this->orderBy('transaksi.tanggal_trx', 'ASC')
            ->orderBy('transaksi.transaksi_id', 'ASC');
        return $this;
    }

    function keluarA($awal, $akhir)
    {
        $this->select('SUM(nominal) as keluar')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 2);
        if ($awal != null) {
            $this->where('tanggal_trx <=', $awal);
            // $this->where('tanggal_trx <=', $akhir);
        }
        return $this;
    }

    function masukA($awal, $akhir)
    {
        $this->select('SUM(nominal) as masuk')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 1);
        if ($awal != null) {
            $this->where('tanggal_trx <=', $awal);
            // $this->where('tanggal_trx <=', $akhir);
        }
        return $this;
    }

    function keluarB($awal, $akhir)
    {
        $this->select('SUM(nominal) as keluar')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 2);
        if ($awal != null) {
            $this->where('tanggal_trx >=', $awal);
            $this->where('tanggal_trx <=', $akhir);
        }
        return $this;
    }

    function masukB($awal, $akhir)
    {
        $this->select('SUM(nominal) as masuk')
            ->join('jenistransaksi', 'jenistransaksi.jenistransaksi_id = transaksi.jenistransaksi_id', 'LEFT')
            ->where('jenis_trx', 1);
        if ($awal != null) {
            $this->where('tanggal_trx >=', $awal);
            $this->where('tanggal_trx <=', $akhir);
        }
        return $this;
    }
}
