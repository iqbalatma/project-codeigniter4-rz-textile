<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogActivitiesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "log_id" => [
                "type" => "INT",
                "unsigned"       => true,
                "auto_increment" => true
            ],
            "log_name" => [
                "type" => "VARCHAR",
                "constraint"     => 64,
            ],
            "log_description" => [
                "type" => "TEXT"
            ],
            "log_tr_collor" => [
                "type" => "ENUM",
                "constraint" => ["success", "danger"],
            ],
            "user_id" => [
                "type" => "INT",
                'unsigned'       => true,
                'null' => true,
            ],
            "log_date DATETIME DEFAULT CURRENT_TIMESTAMP",
            "is_deleted" => [
                "type" => "boolean",
                "default" => 0
            ],
        ]);


        $this->forge->addPrimaryKey("log_id");

        $this->forge->addForeignKey("user_id", "users", "user_id");

        $this->forge->createTable("log_activity", true);
    }

    public function down()
    {
        $this->forge->dropTable("log_activity", true);
    }
}
