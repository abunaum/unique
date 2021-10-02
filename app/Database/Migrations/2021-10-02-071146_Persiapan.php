<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Persiapan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'            => ['type' => 'varchar', 'constraint' => 255],
            'deskripsi'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'harga'         => ['type' => 'int', 'constraint' => 12],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('menu', true);
    }

    public function down()
    {
        if ($this->db->DBDriver != 'SQLite3') // @phpstan-ignore-line
        {
        }

		$this->forge->dropTable('menu', true);
    }
}
