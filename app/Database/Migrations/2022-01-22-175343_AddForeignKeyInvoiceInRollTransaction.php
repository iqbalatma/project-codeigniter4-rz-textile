<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyInvoiceInRollTransaction extends Migration
{
    public function up()
    {

        $fields = [
            'invoice_id'       => [
                'type'           => 'INT',
                'constraint'     => 8
            ],
            'CONSTRAINT FOREIGN KEY(`invoice_id`) REFERENCES `invoices`(`invoice_id`)'
        ];
        $this->forge->addColumn('roll_transactions', $fields);
    }

    public function down()
    {
        //
    }
}
