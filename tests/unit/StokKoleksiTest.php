<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class StokKoleksiTest extends CIUnitTestCase{

    use FeatureTestTrait;


    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'stok_koleksi', [
            'koleksi_id' => 'testing koleksi_id',
            'nomor' => 'Testing nomor',
            'status_tersedia' =>'testing status_tersedia',
            'anggota_id'  => 3,
            'perpus_id'  => 6 ,
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "stok_koleksi/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'stok_koleksi', [
            'koleksi_id' => 'Testing stok_koleksi update',
            'nomor' => 'Testing stok_koleksi update',
            'status_tersedia' => 'Testing stok_koleksi update',
            'anggota_id'  => 3,
            'pustakawan_id'  => 6,
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'stok_koleksi', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'stok_koleksi/all')
             ->assertStatus(200);
    }


}