<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomersMigration extends Migration
{
    public function up()
    {
        // create field
        $this->forge->addField([
            'customer_id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'customer_NIK'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                "null" => true
            ],
            'customer_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                "null" => true
            ],
            'address'       => [
                'type'      => 'TEXT',
                'null'     => true
            ],
            'no_hp'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'update_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => [
                'type'           => 'boolean',
                'default' => 0
            ],
        ]);

        $this->forge->addPrimaryKey("customer_id");

        $this->forge->createTable("customers");
    }

    public function down()
    {
        $this->forge->dropTable("customers");
    }
}
