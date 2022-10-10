<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Arsip extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true],
            'nomor'         => ['type'=>'varchar', 'constraint'=>25, 'null'=>true],
            'judul'         => ['type'=>'varchar', 'constraint'=>225, 'null'=>true],
            'ringkasan'     => ['type'=>'text', 'null'=>true],
            'tgl'           => ['type'=>'date', 'null'=>true], 
            'kategori_id'   => ['type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true],  
            'pengguna_id'   => ['type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true],    
            'created_at'    => ['type'=>'datetime', 'null'=>true],  
            'updated_at'    => ['type'=>'datetime', 'null'=>true],   
            'deleted_at'    => ['type'=>'datetime', 'null'=>true],                     
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'cascade', 'set null');
        $this->forge->addForeignKey('pengguna_id', 'pengguna', 'id', 'cascade');
        $this->forge->createTable('arsip');
    }

    public function down()
    {
        $this->forge->dropTable('arsip');
    }
}
