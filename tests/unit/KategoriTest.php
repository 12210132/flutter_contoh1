<?php

use codeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
* @internal
 */
class BahasaTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kategori', [

            'nama' => 'Testing nama',
            ])->getJSON();
            $js = json_decode($json, true);

            $this->assertTrue($js['id'] > 0);

            $this->call('get', "kategori/".$js['id'])
                ->assertStatus(200);

            $this->call('patch', 'kategori', [
                'nama' => 'testing kategori update'
            ])->assertStatus(200);

            $this->call('delete', 'kategori', [
                'id' => $js['id']
            ])->assertStatus(200);
    }

    public function TestRead(){
        $this->call('get', 'kategori/all')
        ->assertStatus(200);
    }
}