<?php

namespace App\Database\Seeds;

use App\Models\AnggotaModel;
use CodeIgniter\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $id = (new AnggotaModel())->insert([
            'nama_lengkap' => 'Melis',
            'nama_belakang' => 'Mel',
            'email' => 'melismel.mm@gmail.com',
            'nohp' => '085432138906',
            'alamat' => 'Mempawah',
            'kota' => 'Pontianak',
            'gender' => "P",
            'foto' => ' ',
            'tgl_daftar' => '12-10-2022',
            'status_aktif' => "A",
            'berlaku_awal' => '12-10-2022',
            'berlaku_akhir' => '19-10-2022',
            
        ]);
        echo "hasil id = $id";
    }
}
