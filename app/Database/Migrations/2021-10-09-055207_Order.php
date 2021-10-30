<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode'            => ['type' => 'varchar', 'constraint' => 255],
            'item'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'nama_server'         => ['type' => 'varchar', 'constraint' => 225],
            'text'         => ['type' => 'varchar', 'constraint' => 225],
            'deskripsi'         => ['type' => 'varchar', 'constraint' => 225],
            'email'         => ['type' => 'varchar', 'constraint' => 225],
            'status'         => ['type' => 'varchar', 'constraint' => 225],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kode');
        $this->forge->addForeignKey('item', 'menu', 'id', '', 'CASCADE');

        $this->forge->createTable('order', true);
    }

    public function down()
    {
        if ($this->db->DBDriver != 'SQLite3') // @phpstan-ignore-line
        {
            $this->forge->dropForeignKey('order', 'order_item_foreign');
        }

        $this->forge->dropTable('order', true);
    }
}
