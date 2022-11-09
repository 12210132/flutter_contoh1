<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 *  @internal
 */
class PenerbitTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'Penerbit', [
            'nama'  => 'Testing nama',
            'kota'  => 'Testing kota',
            'negara'  => 'Testing negara'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "Penerbit/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'Penerbit', [
            'nama'  => 'Testing nama',
            'kota'  => 'Testing kota',
            'negara' => 'Testing negara',
            'id'     => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'Penerbit', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'Penerbit/all')
             ->assertStatus(200);
    }

    public function testLogout(){
        $this->call('delete', 'login')
             ->assertStatus(302);
    }
}