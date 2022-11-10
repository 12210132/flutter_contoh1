<?php

use codeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
* @internal
 */
class BahasaTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'bahasa', [
            'kode' => 'Testing kode',
            'nama' => 'Testing nama',
            ])->getJSON();
            $js = json_decode($json, true);

            $this->assertTrue($js['id'] > 0);

            $this->call('get', "bahasa/".$js['id'])
                ->assertStatus(200);

            $this->call('patch', 'bahasa', [
                'kode' => 'Testing kode',
                'nama' => 'testing bahasa update'
            ])->assertStatus(200);

            $this->call('delete', 'bahasa', [
                'id' => $js['id']
            ])->assertStatus(200);
    }

    public function TestRead(){
        $this->call('get', 'bahasa/all')
        ->assertStatus(200);
    }
}