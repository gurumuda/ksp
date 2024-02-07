<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaksi_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'jensi_trx' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'anggota_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'jenistransaksi_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'pinjaman_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'beban_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'nominal' => [
                'type' => 'FLOAT',
            ],
            'tanggal_trx' => [
                'type' => 'DATE',
            ],
            'trx_bulan' => [
                'type' => 'VARCHAR',
                'constraint' => '2'
            ],
            'trx_tahun' => [
                'type' => 'VARCHAR',
                'constraint' => '4'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('transaksi_id', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
