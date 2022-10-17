<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'    =>['type'=>'int', 'constraint'=>10, 'unsigned' =>true, 'auto-increment'=>true],
            'nama'  =>['type'=>'varchar', 'constraint'=>10,'null' =>false],
        ]);
        $this->forge->addkey('id');
        $this->forge->createTable('kategori');
    
    }

    public function down()
    {
        $this->forge->dropTable('penerbit');
    }
}
