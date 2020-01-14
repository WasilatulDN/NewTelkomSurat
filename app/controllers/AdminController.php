<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use App\Validation\FileValidation;

class AdminController extends Controller
{

    public function registerAction()
    {   
        $id = $this->session->get('admin')['tipe'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('user/login')->send();          
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
        $id = $this->session->get('admin')['tipe'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('user/login')->send();          
        }
    }

    public function formjenissuratAction()
    {
        $id = $this->session->get('admin')['tipe'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('user/login')->send();          
        }
    }

    public function verifAction()
    {
        $id = $this->session->get('admin')['tipe'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('user/login')->send();          
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
            $jenissurat = jenis_surat::findFirst("id='$surat->jenis_surat'");

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
                'jenis_surat' => $jenissurat->nama_surat,
                'pembuat' => $surat->name,
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
        (new Response())->redirect('user/login')->send();          
        }
        $surat = nomor_surat::findFirst("id='$id'");
        $this->view->data = $surat;
        $this->view->jenis = jenis_surat::findFirst("id='$surat->jenis_surat'");
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
        $id = $this->session->get('admin')['tipe'];
        if ($id == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('user/login')->send();          
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

            if($listjenissurat->deleted == 0)
            {
                $status = "Aktif";
            }
            else{
                $status = "Tidak Aktif";
            }
            $data[] = array(
                'nama_surat' => $listjenissurat->nama_surat,
                'kode_surat' => $listjenissurat->kode_surat,
                'status' => $status,
                'link' => $listjenissurat->id,
                
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
        $listusers = user::find(['order' => 'id DESC']);
        $data = array();

        foreach ($listusers as $listuser)
        {

            if($listuser->status == 1)
            {
                $status_sekarang = "Sudah";
            }
            else
            {
                $status_sekarang = "Belum";
            }

            $data[] = array(
                'username' => $listuser->username,
                'status' => $status_sekarang,
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

    public function deleteAction($id)
    {
        $jenis = jenis_surat::findFirst("id='$id'");
        $jenis->deleted = 1;
        // $cek = nomor_surat::findFirst("jenis_surat='$id'");
        $jenis->update();
        // if ($cek) {
        //     $this->flashSession->error("Tidak dapat menghapus jenis surat.");
        //     // echo("tidak dapat menghapus jenis surat");
        // } else {
        //     $jenis->delete();
        //     $this->flashSession->success("Surat berhasil dihapus.");
        //     // return $this->response->redirect('admin/resetpass' . '/' . $id);
            
        // }
        $this->flashSession->success("Surat berhasil dihapus.");
        return $this->response->redirect('admin/jenissurat');

    }

    public function listuploadAction()
    {

    }

    public function listuploadadminAction()
    {
        
        $surats = nomor_surat::find([
            'order' => 'nomor DESC'
            ]);
        $data = array();

        foreach ($surats as $surat) {

            $jenis = jenis_surat::findFirst([
                "id='$surat->jenis_surat'"
                ]);

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
                'pembuat' => $surat->name,
                'jenis_surat' => $jenis->nama_surat,
                'status' => $status,
                'link' => $surat->id,
            );

        }
        
        $content = json_encode($data);
        return $this->response->setContent($content);

    }

    public function verifdetailAction($id)
    {   
        $ids = $this->session->get('admin')['tipe'];
        if ($ids == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('user/login')->send();          
        }
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
        $ids = $this->session->get('admin')['tipe'];
        if ($ids == NULL) {
            // echo "berhasil login";
            // die();
        (new Response())->redirect('user/login')->send();          
        }
        $this->view->data = user::findFirst("id='$id'");
    }

    public function storeresetpassAction()
    {
        $id = $this->request->getPost('id');
        $user = user::findFirst("id='$id'");

        $password = $this->request->getPost('password');
        $user->password = $this->security->hash($password);
        $user->save();
        // echo "Berhasil Ubah bandngkan di database";
        // echo $user->password;
        // die();
        $this->flashSession->success("Password berhasil diganti.");
        return $this->response->redirect('admin/resetpass' . '/' . $id);
        
    }

    public function storejenissuratAction(){
        $jenis_surat = new jenis_surat();
        $jenis_surat->kode_surat = $this->request->getPost('kode');
        $jenis_surat->nama_surat = $this->request->getPost('nama_surat');
        $jenis_surat->deleted = 0;
        $nama_surat = jenis_surat::findFirst("nama_surat = '$jenis_surat->nama_surat'");
        if($nama_surat){
            $this->flashSession->error("Gagal masukan jenis surat. Jenis surat sudah ada.");

            return $this->response->redirect('admin/formjenissurat');
        }
        else{

            $jenis_surat->save();
            $this->response->redirect('admin/jenissurat');
        }

    }

    public function exportAction()
    {
        //Declaring css
        $header_css = "PUT Your CSS if needed";
        $data_css = "PUT Your CSS if needed";
        //If data comes from model then
        $data = $this->modelsManager->createBuilder()
        ->columns("nomor_surat.id, nomor_surat.name, nomor_surat.nama_surat, nomor_surat.no_surat, nomor_surat.tanggal, nomor_surat.nama_pengupload, nomor_surat.pengecekan, jenis_surat.nama_surat as namajenis, nomor_surat.file")
        ->From('nomor_surat')
        ->innerjoin('jenis_surat', 'nomor_surat.jenis_surat = jenis_surat.id')
        // ->where(" file is not NULL ")
        ->getQuery()
        ->execute(); 
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
        <td style='$header_css'>File</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";

        $no = 1;
        foreach ($data as $row) {

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

            if($row->file == NULL){
                $file = "Belum Upload";
            }
            elseif($row->file != NULL){
                $file = "Sudah Upload";
            }

            $table.= "<tr>
            <td style='$data_css'>$no</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$row->namajenis</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$file</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";
            $no ++;
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
        $data = $this->modelsManager->createBuilder()
        ->columns("nomor_surat.id, nomor_surat.name, nomor_surat.nama_surat, nomor_surat.no_surat, nomor_surat.tanggal, nomor_surat.nama_pengupload, nomor_surat.pengecekan, jenis_surat.nama_surat as namajenis, nomor_surat.file")
        ->From('nomor_surat')
        ->innerjoin('jenis_surat', 'nomor_surat.jenis_surat = jenis_surat.id')
        ->where(" file is not NULL ")
        ->getQuery()
        ->execute(); 
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
        <td style='$header_css'>File</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";

        $no = 1;
        foreach ($data as $row) {

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


            if($row->file == NULL){
                $file = "Belum Upload";
            }
            elseif($row->file != NULL){
                $file = "Sudah Upload";
            }

            $table.= "<tr>
            <td style='$data_css'>$no</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$row->namajenis</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$file</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";

            $no++;
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
        $data = $this->modelsManager->createBuilder()
        ->columns("nomor_surat.id, nomor_surat.name, nomor_surat.nama_surat, nomor_surat.no_surat, nomor_surat.tanggal, nomor_surat.nama_pengupload, nomor_surat.pengecekan, jenis_surat.nama_surat as namajenis, nomor_surat.file")
        ->From('nomor_surat')
        ->innerjoin('jenis_surat', 'nomor_surat.jenis_surat = jenis_surat.id')
        ->where(" file is NULL ")
        ->getQuery()
        ->execute(); 
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
        <td style='$header_css'>File</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";

        $no=1;
        foreach ($data as $row) {

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
            if($row->file == NULL){
                $file = "Belum Upload";
            }
            elseif($row->file != NULL){
                $file = "Sudah Upload";
            }

            $table.= "<tr>
            <td style='$data_css'>$no</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$row->namajenis</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$file</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";

            $no++;
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=SuratBelumUpload.xls" );
        return $table;
    }

}