<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'fullname' => 'Admin',
                'username'    => 'admin',
                'password'    => 'admin',
                'role' => 'admin'
            ],
            [
                'fullname' => 'Owner',
                'username'    => 'owner',
                'password'    => 'owner',
                'role' => 'owner'
            ],
        ];


        foreach ($data as $key => $item) {
            $this->db->table('users')->insert($item);
        }
    }
}
