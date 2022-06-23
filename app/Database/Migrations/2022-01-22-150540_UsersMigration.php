<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersMigration extends Migration
{
    public function up()
    {
        // create field
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'fullname'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 128
            ],
            'username'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
            ],
            'password' => [
                'type'           => 'varchar',
                'constraint'     => 512,
            ],
            'role'      => [
                'type'           => 'ENUM',
                'constraint'     => ['admin', 'owner'],
                'default'        => 'admin',
            ],
            'is_deleted' => [
                'type'           => 'boolean',
                'default' => 0
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'update_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        // create primary key
        $this->forge->addPrimaryKey('user_id');

        // Membuat tabel users
        $this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        // delete foreign key
        $this->forge->dropTable('users', true);
    }
}
