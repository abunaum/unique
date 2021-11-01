<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Dataawal extends Seeder
{
    public function run()
    {
        $group = [
            [
                'name' => 'admin',
                'description' => 'Administrator'
            ],
            [
                'name' => 'seller',
                'description' => 'Seller'
            ]
        ];
        $this->db->table('auth_groups')->insertBatch($group);

        $authgroup = [
            'group_id' => 1,
            'user_id' => 1
        ];
        $this->db->table('auth_groups_users')->insert($authgroup);

        $menu = [
            [
                'nama' => 'Logos',
                'deskripsi' => 'Logo',
                'harga' => 10000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama' => 'Buycraft Icons',
                'deskripsi' => 'Buycraft Icon',
                'harga' => 10000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama' => 'Youtube Channel Arts',
                'deskripsi' => 'Youtube Channel Art',
                'harga' => 10000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];
        $this->db->table('menu')->insertBatch($menu);

        $payment = [
            'apikey' => 'xxxxxxxxxxxx',
            'apiprivatekey' => 'xxxxxxxxxxxx',
            'kodemerchant' => 'xxxxxxxxxxxx',
            'callback' => 'xxxxxxxxxxxx',
            'jenis' => 'sandbox',
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];
        $this->db->table('payment')->insert($payment);
    }
}
