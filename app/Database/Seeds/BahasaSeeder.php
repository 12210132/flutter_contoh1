<?php

namespace App\Database\Seeds;

use App\Models\BahasaModel;
use CodeIgniter\Database\Seeder;

class BahasaSeeder extends Seeder
{
    public function run()
    {
        $id = (new BahasaModel())->insert([
            'kode'=> '1234abc',
            'nama'=> 'Anjelinaanggi',
        ]);
        echo"hasil id = $id ";
    }
}
