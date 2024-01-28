<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jenistransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'jenistransaksi_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'kode_trx' => [
                'type' => 'VARCHAR',
                'constraint' => '15'
            ],
            'nama_trx' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'jenis_trx' => [
                'type'       => 'ENUM("1","2")',
            ],
            'periode_trx' => [
                'type'       => 'ENUM("1","2","3","4")',
            ],
            'nominal_trx' => [
                'type' => 'FLOAT',
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('jenistransaksi_id', true);
        $this->forge->createTable('jenistransaksi');
    }

    public function down()
    {
        $this->forge->dropTable('jenistransaksi');
    }
}
