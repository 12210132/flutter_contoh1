<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 *  @internal
 */
class PerpusTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login',[
            'email' => 'jelihin16@gmail.com',
            'sandi' => '123456'
        ])->assertStatus(404);
    }
    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'Perpus', [
            'nama_lengkap' => 'Testing nama_lengkap',
            'gender' => 'L',
            'tgl_lahir' => 'Testing tgl_lahir',
            'level' => 'P',
            'email' => 'testing@gmail.com',
            'sandi' => 'testing',
            'nohp' => 'testing nohp',
            'alamat' => 'testing alamat',
            'update_at' => 'testing update_at'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "Perpus/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'Perpus', [
            'nama_lengkap' => 'Testing nama_lengkap',
            'gender' => 'L',
            'tgl_lahir' => 'Testing tgl_lahir',
            'level' => 'P',
            'email' => 'testingUpdate@email.com',
            'sandi' => 'testing',
            'nohp' => 'testing nohp',
            'alamat' => 'testing alamat',
            'update_at' => 'testing update_at'
        ])->assertStatus(200);

        $this->call('delete', 'Perpus', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'Perpus/all')
             ->assertStatus(200);
    }

    public function testLogout(){
        $this->call('delete', 'login')
             ->assertStatus(302);
    }
}