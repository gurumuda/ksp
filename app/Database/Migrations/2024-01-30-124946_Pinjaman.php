<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pinjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pinjaman_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'anggota_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'lama_pinjaman' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'nominal_pinjaman' => [
                'type' => 'FLOAT'
            ],
            'tanggal_pinjaman' => [
                'type' => 'DATE'
            ],
            'jasa' => [
                'type' => 'FLOAT'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('pinjaman_id', true);
        $this->forge->createTable('pinjaman');
    }

    public function down()
    {
        $this->forge->dropTable('pinjaman');
    }
}
