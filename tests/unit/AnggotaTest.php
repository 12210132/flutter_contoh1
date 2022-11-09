<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class AnggotaTest extends CIUnitTestCase{

    use FeatureTestTrait;


    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'anggota', [
            'nama_depan' => 'Testing nama_depan',
            'nama_belakang' => 'Testing nama_belakang',
            'email' =>'testing@gmail.com',
            'nohp'  => 'Testing nohp',
            'alamat'  => 'Testing alamat',
            'kota'  => 'Testing kota',
            'gender'   => 'P',
            'foto'    => 'Testing foto',
            'tgl_daftar'    => 'Testing tgl_daftar',
            'status_aktif'  => 'Testing status_aktif',
            'berlaku_awal'  => 'Testing berlaku_awal',
            'berlaku_akhir' => 'Testing berlaku_akhir',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "anggota/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'anggota', [
            'nama_depan' => 'Testing anggota update',
            'nama_belakang' => 'Testing anggota update',
            'email' => 'testingupdate@gmail.com',
            'nohp'  => 'Testing anggota update',
            'alamat'  => 'Testing anggota update',
            'kota'  => 'Testing anggota update',
            'gender'   => 'P',
            'foto'          => 'Testing anggota update',
            'tgl_daftar'    => 'Testing anggota update',
            'status_aktif'  => 'Testing anggota update',
            'berlaku_awal'  => 'Testing anggota update',
            'berlaku_akhir' => 'Testing anggota update',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'anggota', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'anggota/all')
             ->assertStatus(200);
    }


}