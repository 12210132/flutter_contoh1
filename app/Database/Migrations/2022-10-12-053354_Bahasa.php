<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bahasa extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'    =>['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto-increment'=>true],
            'kode'  =>['type'=>'varchar', 'constraint'=>2, 'null' =>false],
            'nama'  =>['type'=>'varchar', 'constraint'=>50, 'null'=>false],


        ]);
        $this->forge->addPrimaryKey('kode');
        $this->forge->createTable('bahasa');
        

    }

    public function down()
    {
        $this->forge->dropTable('bahasa');
    }
}
