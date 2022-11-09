<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penerbit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [ 'type' => 'int', 'auto_increment' => true ],
            'nama'  => [ 'type' => 'varchar', 'constraint' => 100, 'null'=>false ],
            'kota'  => [ 'type' => 'varchar', 'constraint' => 100, 'null'=>true ],
            'negara'  => [ 'type' => 'varchar', 'constraint' => 100, 'null'=>true ],
        ]);
        $this->forge->addKey('id');
        $this->forge->createTable('penerbit');
    }
   
    public function down()
    {
        $this->forge->dropTable('penerbit');
    }
}
