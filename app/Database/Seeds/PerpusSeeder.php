<?php

namespace App\Database\Seeds;

use App\Models\PerpusModel;
use CodeIgniter\Database\Seeder;

class PerpusSeeder extends Seeder
{
    public function run()
    {
       $id =(int)(new PerpusModel())->insert([
        'nama_lengkap'  => 'Jelihin',
        'gender'        => 'L',
        'tgl_lahir'     => '16',
        'level'         => 'K',
        'email'         => 'jelihin16@gmail.com',
        'sandi'         =>  Password_hash('123456', PASSWORD_BCRYPT),
        'nohp'          => '085821042288',
        'alamat'        => 'sungai_raya',
       ]);
       echo "hasil id = $id";

    }
}
