<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PerpusModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

class PerpusController extends BaseController
{
    public function login()
    {
        $email     = $this->request->getPost('email');
        $password  = $this->request->getPost('sandi');

        $Perpus    = (new PerpusModel())->where('email', $email)->first();

        if($Perpus == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $cekPassword = password_verify($password, $Perpus['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                        ->setStatusCode(403);
        }

        $this->session->set('perpus', $Perpus);
        return $this->response->setJSON(['message'=>"selamat datang{$Perpus['nama_lengkap']}"])
                              ->setStatusCode(200);

    }

    public function viewLogin(){
        return view('login');
    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');

        $Perpus = (new PerpusModel())->where('email', $_email)->first();

        if($Perpus == null){
            return $this->response->setJSON(['massage'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5 );
        $Perpus['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new PerpusModel())->update($Perpus['id'], $Perpus);

        if($r == false){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('jelihin16@gmail.com', 'Sistem Arsip Digital');
        $email->setTo($Perpus['email']);
        $email->setSubject('Reset Sandi Perpus');
        $email->setMessage("Hallo {$Perpus['nama_lengkap']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message'=>"Sandi baru sudah di kirim ke alamat email $email"])
                        ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengirim email ke $email"])
                        ->setStatusCode(500);
        }

    }
    public function viewLupaPassword(){
        return view('lupaPassword');
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }

    public function index(){
        return view('Perpus/table');
    }

    public function all(){
        $pm = new PerpusModel();
        $pm->select('id, nama_lengkap, gender, tgl_lahir, level, email, sandi, nohp, alamat, update_at');

        return (new DataTable( $pm ))
               ->setFieldFilter(['nama_lengkap', 'gender', 'tgl_lahir', 'level', 'email', 'sandi', 'nohp', 'alamat', 'update_at'])
               ->draw();
    }

    public function show($id){
        $r= (new PerpusModel())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm = new PerpusModel();
        $sandi = $this->request->getvar('sandi');

        $id = $pm->insert([
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'gender' => $this->request->getVar('gender'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'level' => $this->request->getVar('level'),
            'email' => $this->request->getVar('email'),
            'sandi' =>password_hash($sandi, PASSWORD_BCRYPT),
            'nohp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
            'update_at' => $this->request->getVar('update_at'),
        ]);
        return $this->response->setJSON(['id'=>$id])
            ->setStatusCode(intval($id) > 0 ? 200 : 406);
    }

    public function update(){
        $pm = new PerpusModel();
        $id = (int)$this->request->getvar('id');

        if($pm->find($id) == null)

        $hasil = $pm-> update($id,[
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'gender' => $this->request->getVar('gender'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'level' => $this->request->getVar('level'),
            'email' => $this->request->getVar('email'),
            'sandi' => $this->request->getVar('sandi'),
            'nohp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
            'update_at' => $this->request->getvar('update_at')
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm = new PerpusModel();
        $id = $this->request->getvar('id');
        $hasil = $pm->delete($id);
        return $this->response->setJSON(['result'=>$hasil]);
    }   
}