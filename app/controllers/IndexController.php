<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use App\Events\AdminProtectController;
use App\Validation\FileValidation;


// use App\Events\UserProtectController;

class IndexController extends Controller
{
    public function indexAction()
    {
        
    }
    public function carinomorAction()
    {
        
    }
    public function detailnomorAction()
    {
        
    }

    public function createAction()
    {
        $this->flashSession->clear();
        $id = $this->session->get('admin')['username'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('loginadmin')->send();          
        }
    }

    public function loginadminAction()
    {
        $this->flashSession->clear();
        $id = $this->session->get('admin')['username'];
        if ($id != NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('halamanadmin')->send();          
        }
    }

    public function storeAction(){

        $admin = new admin();
        $admin->username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // echo $password;
        // die();
        $admin->password = $this->security->hash($password);
        $user = admin::findFirst("username = '$admin->username'");
        if ($user) { 
            $this->flashSession->error("Gagal register. Username telah digunakan.");
            return $this->response->redirect('register');
        }
        else
        {
            $admin->save();
            $this->response->redirect('halamanadmin');

        }
        
    }

    // public function create1Action()
    // {
    //     $_isAdmin = $this->session->get('admin');
    //     if ($_isAdmin) {
    //         return $this->response->redirect('halamanadmin');
    //     } else {
    //         return $this->response->redirect('loginadmin');
    //     }
    // }

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

                (new Response())->redirect('halamanadmin')->send();
            }
            else{
                $this->response->redirect('loginadmin');
            }
        }
        $this->flashSession->error("Gagal masuk. Silakan cek kembali username dan password anda.");
        return $this->response->redirect('loginadmin');
    }
    public function nomorAction()
    {
        // $data = nomor_surat::findFirst("idKMS='$idp'");
        $max = nomor_surat::maximum(
            [
                'column' => 'id',
            ]
        );
        $data = nomor_surat::findFirst("id='$max'");
        // if($data) echo("ada");
        // else echo("tidak"); die();
        $this->view->data = $data;
        
    }
    
    public function halamanadminAction()
    {       
        $id = $this->session->get('admin')['username'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('loginadmin')->send();          
        }
    }
        

    public function lihatdetailAction($id)
    {       
        $user = $this->session->get('admin')['username'];
        if ($user == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('loginadmin')->send();          
        }
        $this->view->data = nomor_surat::findFirst("id='$id'");
    }
    // public function registerAction()
    // {
        

    //}
    public function nomorterpakaiAction()
    {
        
    }

    // }

    public function show404Action()
    {
        
    }
    public function storesuratAction()
    {
        $tanggal = $this->request->getPost('tanggal');
        $jenissurat = $this->request->getPost('jenissurat');
        $data = nomor_surat::findFirst(
            [
                "tanggal='$tanggal'",
                'order' => 'id DESC',
                'limit' => 1,
            ]
        );
        if($data)
        {
            echo("ada");
            $nomor = $data->nomor+1;
            // echo ($data->nama_surat);
            // var_dump($data);
            // die();
        }
        else{
            // echo("tidak ada");
            // $max = nomor_surat::maximum(
            //     [
            //         'column' => 'nomor',
            //     ]
            // );
            $data = nomor_surat::findFirst(
                [
                    // 'condition' => 'tanggal < ?1',
                    "tanggal<'$tanggal'",
                    'order' => 'tanggal DESC',
                    'limit' => 1,
                ]
            );
            if($data)
            {
                $tanggal1 = strtotime($tanggal);
                $tanggal2 = strtotime($data->tanggal);
                $diff = abs($tanggal1 - $tanggal2)/60/60/24; 
                // $difftanggal = $diff-1;
                // echo($diff);
                // var_dump($data);
                // die();
            
                $nomor=$data->nomor + (5*$diff);
                
            }
            else
            {
                $nomor=1;
            }
            
            
        }
        $cek = nomor_surat::findFirst("nomor='$nomor'");
        if($cek)
        {
            $this->response->redirect('nomorterpakai');
        }
        else{
            if($jenissurat == 5)
            {
                $nomorsurat = "TEL.".($nomor)."/LG000/R5W-5M470000/2020";
            }
            elseif($jenissurat == 6)
            {
                $nomorsurat = "TEL.".($nomor)."/YN100/R5W-5M470000/2020";
            }
            else
            {
                $nomorsurat = "TEL.".($nomor)."/YN000/R5W-5M470000/2020";
            }
            echo($nomorsurat);
            // die();
            $surat = new nomor_surat();
            $surat->name = $this->request->getPost('nama');
            $surat->nama_surat = $this->request->getPost('namasurat');
            $surat->jenis_surat = $jenissurat;
            $surat->nomor = $nomor;
            $surat->no_surat = $nomorsurat;
            $surat->tanggal = $this->request->getPost('tanggal');
            $surat->save();
            $this->response->redirect('nomor');
        }

        
    }
   
    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect();
    }

    public function listsuratAction()
    {
        // $id = $this->session->get('auth')['id'];
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
                        'nama' => $surat->name,
                        'nama_surat' => $surat->nama_surat,
                        'jenis_surat' => $jenissurat,
                        'status' => $status,
                        'link' => $surat->id,
                    );


            }
            
            $content = json_encode($data);
            return $this->response->setContent($content);
    }

    public function listsuratadminAction()
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

    public function uploadAction($id)
    {
        // $this->flashSession->clear();
        $this->view->data = nomor_surat::findFirst("id='$id'");

    }

    public function storeuploadAction()
    {
        $id = $this->request->getPost('id');
        $val2 = new FileValidation();
        $messages2 = $val2->validate($_FILES);
        if (count($messages2)) {
			$this->flashSession->error("GAGAL UPLOAD. Pastikan format file .jpg atau .pdf dan ukuran tidak melebihi 2MB");
            return $this->response->redirect('upload' . '/' . $id);
        }
        else
        {
            
            $surat = nomor_surat::findFirst("id='$id'");

            if (true == $this->request->hasFiles() && $this->request->isPost()) {
                $upload_dir = __DIR__ . '/../../public/uploads/';
          
                if (!is_dir($upload_dir)) {
                  mkdir($upload_dir, 0755);
                }
                foreach ($this->request->getUploadedFiles() as $file) {
                    $temp = explode(".", $_FILES["file"]["name"]);
                  $file->moveTo($upload_dir . $file->getName());
                    $lama = $upload_dir.$file->getName();
                    $baru = $upload_dir. 'TEL' .$surat->nomor. '.' .end($temp);
                    rename($lama, $baru);
                
                }
            }

            $surat->nama_pengupload = $this->request->getPost('pengupload');
            $surat->file = 'TEL' .$surat->nomor. '.' .end($temp);
    
            $surat->save();

            $this->response->redirect('detailnomor');

        }
        

    }

    public function downloadAction($id)
    { 
        $surat = nomor_surat::findFirst("id='$id'");
        $upload_dir = __DIR__ . '/../../public/uploads/';
        $path = $upload_dir.$surat->file;
        $filetype = filetype($path);
        $filesize = filesize($path);
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Download');
        header('Content-type: '.$filetype);
        header('Content-length: ' . $filesize);
        header('Content-Disposition: attachment; filename="'.$surat->file.'"');
        readfile($path);
        // die();*/
     }


}