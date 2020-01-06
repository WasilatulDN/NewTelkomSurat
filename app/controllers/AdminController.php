<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use App\Validation\FileValidation;

class AdminController extends Controller
{
    public function registerAction()
    {
        $id = $this->session->get('admin')['username'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('admin/login')->send();          
        }
    }

    public function storeregisterAction(){

        $admin = new admin();
        $admin->username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // echo $password;
        // die();
        $admin->password = $this->security->hash($password);
        $user = admin::findFirst("username = '$admin->username'");
        if ($user) { 
            $this->flashSession->error("Gagal register. Username telah digunakan.");
            return $this->response->redirect('admin/register');
        }
        else
        {
            $admin->save();
            $this->response->redirect('admin/list');

        }
        
    }

    public function storeloginAction()
    {
        $username = $this->request->getPost('username');
        $pass = $this->request->getPost('password');
        // echo $pass;
        // die();
        $user = admin::findFirst("username = '$username'");
        // echo $user->password;
        // die();
        if ($user){
            if($this->security->checkHash($pass, $user->password)){
                $this->session->set(
                    'admin',
                    [
                        'id' => $user->id,
                        'username' => $user->username,
                    ]
                );

                (new Response())->redirect('admin/list')->send();
            }
            else{
                $this->flashSession->error("Gagal masuk. Silakan cek kembali username dan password anda.");
                $this->response->redirect('admin/login');
            }
        }
        else{
            $this->flashSession->error("Gagal masuk. Silakan cek kembali username dan password anda.");
                $this->response->redirect('admin/login');
        }

    }

    public function loginAction()
    {
        $id = $this->session->get('admin')['username'];
        if ($id != NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('admin/list')->send();          
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect();
    }

    public function listsuratAction()
    {
        $surats = nomor_surat::find(['order' => 'nomor DESC']);
        $data = array();

        foreach ($surats as $surat) {

            if($surat->jenis_surat == 1)
            {
                $jenissurat = "Berita Acara Penjelasan";
            }
            elseif($surat->jenis_surat == 2)
            {
                $jenissurat = "BASO";
            }
            elseif($surat->jenis_surat == 3)
            {
                $jenissurat = "BADO";
            }
            elseif($surat->jenis_surat == 4)
            {
                $jenissurat = "Surat Keluar";
            }
            elseif($surat->jenis_surat == 5)
            {
                $jenissurat = "P0/P1";
            }
            elseif($surat->jenis_surat == 6)
            {
                $jenissurat = "Surat Penawaran";
            }

            if($surat->file)
            {
                $status = "Sudah";
            }
            else{
                $status = "Belum";
            }
            
            $data[] = array(
                'no_surat' => $surat->no_surat,
                'tanggal' => $surat->tanggal,
                'nama_surat' => $surat->nama_surat,
                'jenis_surat' => $jenissurat,
                'status' => $status,
                'link' => $surat->id,
            );
        }
        
        $content = json_encode($data);
        return $this->response->setContent($content);
    }

    public function detailAction($id)
    {       
        $user = $this->session->get('admin')['username'];
        if ($user == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('admin/login')->send();          
        }
        $this->view->data = nomor_surat::findFirst("id='$id'");
    }

    public function listAction()
    {       
        $id = $this->session->get('admin')['username'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('admin/login')->send();          
        }
    }

}