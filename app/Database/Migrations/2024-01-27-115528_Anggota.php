<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggota extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'anggota_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '40'
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '70'
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
            'tmp_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => '30'
            ],
            'tgl_lahir' => [
                'type' => 'DATE'
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM("1","2")'
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => '16'
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('anggota_id', true);
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}
