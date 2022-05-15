<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InvoicesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'invoice_id'          => [
                'type'           => 'INT',
                'constraint'     => 8,
                'auto_increment' => true
            ],
            'invoice_code'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 64
            ],
            'total_capital'       => [
                'type'           => 'INT',
                'constraint'     => 16
            ],
            'total_payment'       => [
                'type'           => 'INT',
                'constraint'     => 16
            ],
            'total_profit'       => [
                'type'           => 'INT',
                'constraint'     => 16
            ],
            'type_payment'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 11,
            ],
            'customer_id'       => [
                'type'           => 'INT',
                'unsigned'       => true,
                "null" => true
            ],
            'is_paid'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0

            ],
            'user_id'       => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'date_invoice DATETIME DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => [
                'type'           => 'boolean',
                'default' => false
            ],
        ]);

        // 164900

        // 164157
        $this->forge->addPrimaryKey('invoice_id');

        $this->forge->addForeignKey('customer_id', "customers", "customer_id");
        $this->forge->addForeignKey('user_id', "users", "user_id");

        $this->forge->createTable('invoices', true);
    }

    public function down()
    {
        $this->forge->dropTable('invoices', true);
    }
}
