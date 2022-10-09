<?php

namespace App\Database\Seeds;

use App\Models\PenggunaModel;
use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $id = (new PenggunaModel())->insert([
            'nama' => 'Administrator',
            'gender' => 'L',
            'email' =>'melismel.mm@gmail.com',
            'sandi' => password_hash('123456', PASSWORD_BCRYPT),
        ]);
        echo "hasil id - $id";
    }
}
