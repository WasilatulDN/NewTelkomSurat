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

    public function jenissuratAction()
    {

    }

    public function formjenissuratAction()
    {

    }

    public function verifAction()
    {

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

            if($surat->pengecekan == 1)
            {
                $verifikasi = "Terverifikasi";
            }
            elseif($surat->pengecekan == -1)
            {
                $verifikasi = "Ditolak";
            }
            else
            {
                $verifikasi = "Belum Verifikasi";
            }
            
            $data[] = array(
                'no_surat' => $surat->no_surat,
                'tanggal' => $surat->tanggal,
                'nama_surat' => $surat->nama_surat,
                'jenis_surat' => $jenissurat,
                'status' => $status,
                'verifikasi' => $verifikasi,
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

    public function verifikasiAction($id)
    {
        $surat = nomor_surat::findFirst("id='$id'");
        $surat->pengecekan = 1;
        $surat->save();
        return $this->response->redirect('admin/detail' . '/' . $id);
    }

    public function tolakAction($id)
    {
        $surat = nomor_surat::findFirst("id='$id'");
        $surat->pengecekan = -1;
        $surat->save();
        return $this->response->redirect('admin/detail' . '/' . $id);
    }

    public function urungkanAction($id)
    {
        $surat = nomor_surat::findFirst("id='$id'");
        $surat->pengecekan = 0;
        $surat->save();
        return $this->response->redirect('admin/detail' . '/' . $id);
    }

    public function listAction()
    {       
        $id = $this->session->get('admin')['username'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('admin/login')->send();          
        }
        $datas = nomor_surat::find();
        $sudah = 0;
        $belum = 0;
        $array;
        foreach ($datas as $data) {
            if($data->file)
            {
                $sudah++;
            }
            else{
                $belum++;
            }
        }
        $array[0] = $sudah;
        $array[1] = $belum;
        // var_dump($array);
        // echo $sudah;
        // echo("\n");
        // echo $belum;
        // die();
        $this->view->data = $array;
    }

    public function listjenissuratAction()
    {
        $listjenissurats = jenis_surat::find();
        $data = array();

        foreach ($listjenissurats as $listjenissurat)
        {

            
            $data[] = array(
                'nama_surat' => $listjenissurat->nama_surat,
                'kode_surat' => $listjenissurat->kode_surat,
                // 'jenis_surat' => $jenissurat,
                // 'status' => $status,
                // 'verifikasi' => $verifikasi,
            );
        }

        $content = json_encode($data);
        return $this->response->setContent($content);

    }

    public function listjenisAction()
    {

    }

    public function listuserAction()
    {
        $listusers = user::find();
        $data = array();

        foreach ($listusers as $listuser)
        {

            
            $data[] = array(
                'username' => $listuser->username,
                // 'status' => $status,
                'link' => $listuser->id,
                // 'verifikasi' => $verifikasi,
            );
        }

        $content = json_encode($data);
        return $this->response->setContent($content);

    }

    public function listuserviewAction($id)
    {

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
        <td style='$header_css'>Nomor Surat</td>
        <td style='$header_css'>Tanggal</td>
        <td style='$header_css'>Status Verifikasi</td>
        <td style='$header_css'>Setuju/Tidak</td>
        </tr>";
        foreach ($data as $row) {
            if($row->jenis_surat == 1)
            {
                $jenissurat = "Berita Acara Penjelasan";
            }
            elseif($row->jenis_surat == 2)
            {
                $jenissurat = "BASO";
            }
            elseif($row->jenis_surat == 3)
            {
                $jenissurat = "BADO";
            }
            elseif($row->jenis_surat == 4)
            {
                $jenissurat = "Surat Keluar";
            }
            elseif($row->jenis_surat == 5)
            {
                $jenissurat = "P0/P1";
            }
            elseif($row->jenis_surat == 6)
            {
                $jenissurat = "Surat Penawaran";
            }


            if($row->pengecekan == 1)
            {
                $verifikasi = "Terverifikasi";
            }
            elseif($row->pengecekan == -1)
            {
                $verifikasi = "Ditolak";
            }
            else
            {
                $verifikasi = "Belum Verifikasi";
            }

            $table.= "<tr>
            <td style='$data_css'>$row->id</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$jenissurat</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=DataSurat.xls" );
        return $table;
    }

    public function exportSudahAction()
    {
        //Declaring css
        $header_css = "PUT Your CSS if needed";
        $data_css = "PUT Your CSS if needed";
        //If data comes from model then
        $data = nomor_surat::find(["file is not NULL"]);
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
        <td style='$header_css'>Nomor Surat</td>
        <td style='$header_css'>Tanggal</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";
        foreach ($data as $row) {
            if($row->jenis_surat == 1)
            {
                $jenissurat = "Berita Acara Penjelasan";
            }
            elseif($row->jenis_surat == 2)
            {
                $jenissurat = "BASO";
            }
            elseif($row->jenis_surat == 3)
            {
                $jenissurat = "BADO";
            }
            elseif($row->jenis_surat == 4)
            {
                $jenissurat = "Surat Keluar";
            }
            elseif($row->jenis_surat == 5)
            {
                $jenissurat = "P0/P1";
            }
            elseif($row->jenis_surat == 6)
            {
                $jenissurat = "Surat Penawaran";
            }

            if($row->pengecekan == 1)
            {
                $verifikasi = "Terverifikasi";
            }
            elseif($row->pengecekan == -1)
            {
                $verifikasi = "Ditolak";
            }
            else
            {
                $verifikasi = "Belum Verifikasi";
            }


            $table.= "<tr>
            <td style='$data_css'>$row->id</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$jenissurat</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=SuratSudahUpload.xls" );
        return $table;
    }

    public function exportBelumAction()
    {
        //Declaring css
        $header_css = "PUT Your CSS if needed";
        $data_css = "PUT Your CSS if needed";
        //If data comes from model then
        $data = nomor_surat::find(["file is NULL"]);
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
        <td style='$header_css'>Nomor Surat</td>
        <td style='$header_css'>Tanggal</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";
        foreach ($data as $row) {
            if($row->jenis_surat == 1)
            {
                $jenissurat = "Berita Acara Penjelasan";
            }
            elseif($row->jenis_surat == 2)
            {
                $jenissurat = "BASO";
            }
            elseif($row->jenis_surat == 3)
            {
                $jenissurat = "BADO";
            }
            elseif($row->jenis_surat == 4)
            {
                $jenissurat = "Surat Keluar";
            }
            elseif($row->jenis_surat == 5)
            {
                $jenissurat = "P0/P1";
            }
            elseif($row->jenis_surat == 6)
            {
                $jenissurat = "Surat Penawaran";
            }

            if($row->pengecekan == 1)
            {
                $verifikasi = "Terverifikasi";
            }
            elseif($row->pengecekan == -1)
            {
                $verifikasi = "Ditolak";
            }
            else
            {
                $verifikasi = "Belum Verifikasi";
            }


            $table.= "<tr>
            <td style='$data_css'>$row->id</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$jenissurat</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=SuratBelumUpload.xls" );
        return $table;
    }


    public function verifdetailAction($id)
    {
        $this->view->data = user::findFirst("id='$id'");
    }
    
    public function verifikasiuserAction($id)
    {
        // echo $id;
        // die();
        $user = user::findFirst("id='$id'");
        $user->status = 1;
        $user->save();
        return $this->response->redirect('admin/verifdetail' . '/' . $id);
    }

    public function resetpassAction($id)
    {
        $this->view->data = user::findFirst("id='$id'");
    }

    public function storeresetpassAction()
    {
        $id = $this->request->getPost('id');
        $user = user::findFirst("id='$id'");

        $password = $this->request->getPost('password');
        $user->password = $this->security->hash($password);
        $user->save();
        echo "Berhasil Ubah bandngkan di database";
        echo $user->password;
        die();
    }
}