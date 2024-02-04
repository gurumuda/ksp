<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Koperasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'koperasi_id' => [
                'type'           => 'INT',
                'constraint'     => 1
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'no' => [
                'type' => 'VARCHAR',
                'constraint' => 40
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'kas' => [
                'type' => 'FLOAT'
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('koperasi_id', true);
        $this->forge->createTable('koperasi');
    }

    public function down()
    {
        $this->forge->dropTable('koperasi');
    }
}
