<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perpus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [ 'type' => 'int', 'constraint'=> 10, 'unsigned'=>true, 'auto_increment'=>true ],
            'nama_lengkap'  => [ 'type' => 'varchar', 'constraint'=> 80, 'null' => false ],
            'gender'        => [ 'type' => 'enum("L","P")',  'null' => true ],
            'tgl_lahir'     => [ 'type' => 'date', 'null'  =>true ],
            'level'         => [ 'type' => 'enum("P","K")', 'null' => true ],
            'email'         => [ 'type' => 'varchar', 'constraint'=> 255, 'null' => false ],
            'sandi'         => [ 'type' => 'varchar', 'constraint'=> 60,  'null' => false ],
            'nohp'          => [ 'type' => 'varchar', 'constraint'=> 15, 'null' => true],
            'alamat'        => [ 'type' => 'varchar', 'constraint'=> 255, 'null' => true ],
            'token_reset'   => [ 'tyep' => 'varchar', 'constraint'=> 10, 'null' => true ],
            'created_at'    => [ 'type' => 'datetime', 'null' =>true ],
            'update_at'     => [ 'type' => 'datetime', 'null' =>true ],
            'deleted_at'    => [ 'type' => 'datetime', 'null' =>true ],
        ]);
        $this->forge->addKey( 'id' );
        $this->forge->createTable( 'perpus' );
    }

    
    public function down()
    {
        $this->forge->dropTable( 'perpus' );
    }
}
