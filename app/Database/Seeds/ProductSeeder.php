<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'ASUS TUF A15 FA506NF',
                'harga'  => 10899000,
                'jumlah' => 5,
                'foto' => 'asus_tuf_a15.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'LENOVO LOQ IRX9',
                'harga'  => 14125000,
                'jumlah' => 7,
                'foto' => 'lenovo_loq_irx9.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'ACER NITRO V15',
                'harga'  => 15299000,
                'jumlah' => 5,
                'foto' => 'acer_nitro_v15.JPG',
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            $this->db->table('product')->insert($item);
        }
    }
}
