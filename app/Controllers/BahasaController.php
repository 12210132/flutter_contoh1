<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use app\models\bahasacontrollermodel;
use App\Models\BahasaModel;
use codeigniter\email\email;
use CodeIgniter\Exceptions\PageNotFoundException;
use config\email as configemail;

class BahasaController extends BaseController
{  
    public function index(){
        return view('Bahasa/table');
    }

    public function all(){
        $pm = new BahasaModel();
        $pm->select('id, kode, nama');

       return (new DataTable($pm))
              ->setFieldFilter(['kode', 'nama'])
              ->draw();
    }
    
    public function show($id){
        $r = (new BahasaModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm  = new BahasaModel();
        
        $id = $pm->insert([
            'kode'  => $this->request->getVar('kode'),
            'nama'  => $this->request->getVar('nama'),
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm  = new BahasaModel();
        $id  = (int)$this->request->getVar('id');

        if( $pm->find($id) == null )
             throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'kode'  => $this->request->getVar('kode'),
            'nama'  => $this->request->getVar('nama'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm  = new BahasaModel();
        $id  = $this->request->getVar('id');
        $hasil = $pm->delete($id);
        return $hasil->response->setJSON(['result' => $hasil ]);
    }

}

