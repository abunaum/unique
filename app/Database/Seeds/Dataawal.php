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

        $user = [
            [
                'email' => 'abunaumv3@gmailcom',
                'username' => 'admin',
                'password_hash' => '$2y$10$PZoSwgYf7eUoJGy893AwD.Ytd.CIRJC9GGpZIbUcT7bvPWStEBZzW',
                'active' => 1,
                'force_pass_reset' => 0,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'email' => 'andialfa11@gmail.com',
                'username' => 'seller',
                'password_hash' => '$2y$10$PZoSwgYf7eUoJGy893AwD.Ytd.CIRJC9GGpZIbUcT7bvPWStEBZzW',
                'active' => 1,
                'force_pass_reset' => 0,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];
        $this->db->table('users')->insertBatch($user);

        $authgroup = [
            [
                'group_id' => 1,
                'user_id' => 1
            ],
            [
                'group_id' => 2,
                'user_id' => 2
            ]
        ];
        $this->db->table('auth_groups_users')->insertBatch($authgroup);

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
