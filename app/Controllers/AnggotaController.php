<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use CodeIgniter\Email\Email;
use Config\Email as ConfigEmail;

class AnggotaController extends BaseController
{
    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('sandi');

        $anggota    = (new AnggotaModel())->where('email', $email)->first();

        if($anggota == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $cekPassword = password_verify($password, $anggota['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                        ->setStatusCode(403);
        }

        $this->session->set('anggota', $anggota);
        return $this->response->setJSON(['messege'=>"Selamat datang {$anggota['nama_lengkap']} "])
                    ->setStatusCode(200);

    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');

        $anggota = (new AnggotaModel())->where('email', $_email)->first();

        if($anggota == null){
            return $this->response->setJSON(['messege'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);  
        }
        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5 );
        $anggota['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new AnggotaModel())->update($anggota['id'], $anggota);

        if($r == false){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('melismel.mm@gmail.com', 'perpustakaan');
        $email->setTo($anggota['EMAIL']);
        $email->setSubject('Reset Sandi Anggota');
        $email->setMessage("Hallo {$anggota['nama_lengkap']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['messege'=>"Maaf ada kesalahan pengiriman email ke $_email"])
                        ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['messege'=>"Maaf ada kesalahan pengriman ke $_email"])
                        ->setStatusCode(500);
        }
        
    }
}
