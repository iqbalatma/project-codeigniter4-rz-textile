<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RollTransactionsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaction_id'          => [
                'type'           => 'INT',
                'constraint'     => 8,
                'auto_increment' => true
            ],
            'roll_id'       => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'transaction_type' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
            ],
            'transaction_quantity'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
            ],
            'transaction_quantity_total'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
            ],
            'sub_capital'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
                "null" => true,
            ],
            'sub_total'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
                "null" => true,
            ],
            'sub_profit'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                "default" => 0,
                "null" => true,
            ],
            'type_payment'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 11,
            ],
            'transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => [
                'type'           => 'boolean',
                'default' => false
            ],
        ]);

        $this->forge->addPrimaryKey('transaction_id');

        $this->forge->addForeignKey('roll_id', "rolls", "roll_id");

        $this->forge->createTable('roll_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('roll_transactions');
    }
}
