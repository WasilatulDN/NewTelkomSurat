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

    public function exportAction()
    {
        //Declaring css
        $header_css = "PUT Your CSS if needed";
        $data_css = "PUT Your CSS if needed";
        //If data comes from model then
        $data = nomor_surat::find();
        //As i'm using join query i feel good using createBuilder
        // $data = $this->modelsManager->createBuilder()
        //       ->columns("comment.comment, comment.username, comment.email, comment.postedat,item.name,item.photo,item.view,item.categoryid,item.id")
        //       ->From('comment')
        //       ->innerjoin('item', 'comment.productid = item.id')
        //       ->where("comment.email = 'pass your value here' ")
        //       ->getQuery()
        //       ->execute(); 

        $table = "<table>
        <tr>
        <td style='$header_css'>No</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>Nama Surat</td>
        <td style='$header_css'>Jenis Surat</td>
        <td style='$header_css'>Nomor</td>
        <td style='$header_css'>Nomor Surat</td>
        <td style='$header_css'>Tanggal</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>Setuju/Tidak</td>
        </tr>";
        foreach ($data as $row) {
            $table.= "<tr>
            <td style='$data_css'>$row->id</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$row->jenis_surat</td>
            <td style='$data_css'>$row->nomor</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$row->pengecekan</td>
            </tr>";
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=DataSurat.xls" );
        return $table;
    }
}