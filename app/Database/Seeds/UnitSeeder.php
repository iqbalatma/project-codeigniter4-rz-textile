<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'unit_name' => 'Kilogram',
                'unit_code'    => 'kg'
            ],
            [
                'unit_name' => 'Yards',
                'unit_code'    => 'yd'
            ],
            [
                'unit_name' => 'Ton',
                'unit_code'    => 'ton'
            ],
            [
                'unit_name' => 'Ons',
                'unit_code'    => 'ons'
            ],
            [
                'unit_name' => 'Gram',
                'unit_code'    => 'gr'
            ],
        ];

        foreach ($data as $key => $item) {
            $this->db->table('units')->insert($item);
        }
    }
}
