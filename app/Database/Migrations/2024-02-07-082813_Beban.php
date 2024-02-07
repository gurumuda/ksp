<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Beban extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'beban_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_trx' => [
                'type' => 'VARCHAR',
                'constraint' => '150'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('beban_id', true);
        $this->forge->createTable('beban');
    }

    public function down()
    {
        $this->forge->dropTable('beban');
    }
}
