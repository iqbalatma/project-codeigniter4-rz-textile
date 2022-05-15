<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitsMigration extends Migration
{
    public function up()
    {
        // create field
        $this->forge->addField([
            'unit_id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'unit_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 64
            ],
            'unit_code'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 64
            ],
            'is_deleted' => [
                'type'           => 'boolean',
                'default' => 0
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'update_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addPrimaryKey("unit_id");

        $this->forge->createTable("units");
    }

    public function down()
    {
        $this->forge->dropTable("units");
    }
}
