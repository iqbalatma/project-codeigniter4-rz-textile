<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RollsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'roll_id'          => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'roll_code'       => [
                'type'           => 'VARCHAR',
                'unique'            => TRUE,
                'constraint'     => 64
            ],
            'barcode_code'       => [
                'type'           => 'VARCHAR',
                'unique'            => TRUE,
                'constraint'     => 64
            ],
            'roll_name' => [
                'type'           => 'varchar',
                'constraint'     => 128,
            ],
            'unit_quantity'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
            ],
            'roll_quantity'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
            ],
            'all_quantity'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
            ],
            'basic_price'      => [
                'type'           => 'INT',
                'constraint'     => 32,
                "default" => 0,
            ],
            'selling_price'      => [
                'type'           => 'INT',
                'constraint'     => 32,
                "default" => 0,
            ],
            'barcode_image'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                "null" => true,
                "default" => null,
            ],
            'unit_id'      => [
                "type" => "INT",
                'unsigned'       => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'update_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => [
                'type'           => 'boolean',
                'default' => false
            ],
        ]);

        $this->forge->addPrimaryKey('roll_id');

        $this->forge->createTable('rolls');
    }

    public function down()
    {
        $this->forge->dropTable('rolls');
        //
    }
}
