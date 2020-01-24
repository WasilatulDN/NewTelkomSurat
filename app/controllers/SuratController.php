<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use App\Validation\FileValidation;

class SuratController extends Controller
{
    public function listAction()
    {
        // $_isAdmin = $this->session->get('admin');
        $_isUser = $this->session->get('user');

        // if ($_isAdmin) 
        // {
        //     $this->response->redirect('admin/list');
        // }
        if (!$_isUser)
        {
            $this->response->redirect('user/login');
        }
    }

    public function weekendAction()
    {

    }

    public function nomorAction()
    {
        $_isAdmin = $this->session->get('admin')['tipe'];
        $_isUser = $this->session->get('user')['tipe'];
        // if ($_isAdmin == 1) {
        //     $this->response->redirect('admin/list');
        // }
        if(!$_isUser && !$_isAdmin)
        {
            $this->response->redirect('user/login');
        }

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

    public function generatesuratAction()
    {
        $tanggal = $this->request->getPost('tanggal');
        $cektanggal = strtotime($tanggal);
        $hari = date('l', $cektanggal);
        echo $hari;
        if($hari == "Saturday" || $hari == "Sunday")
        {
            return $this->response->redirect('surat/weekend');
        }
        else
        {
            $jenissurat = $this->request->getPost('jenissurat');
            $kodesurat = jenis_surat::findFirst(
                [
                    "id='$jenissurat'"
                ]
            );
            $ttd = $this->request->getPost('ttd');
            $data = nomor_surat::findFirst(
                [
                    "tanggal='$tanggal'",
                    'order' => 'id DESC',
                    'limit' => 1,
                ]
            );
            if($data)
            {
                $ceksetelah = nomor_surat::findFirst(
                    [
                        "tanggal>'$tanggal'",
                        'order' => 'id ASC',
                        'limit' => 1,
                    ]
                );
                if($ceksetelah)
                {
                    // $tanggal1 = strtotime($tanggal);
                    // $tanggal2 = strtotime($ceksetelah->tanggal);
                    // $diff = abs($tanggal2 - $tanggal1)/60/60/24;  
                    // $diff--;           
                    // $nomorbaru = $ceksetelah->nomor - $data->nomor -(10*$diff);


                    $tanggal1 = strtotime($tanggal);
                    $tanggal2 = strtotime($ceksetelah->tanggal);
                    $tanggalcek = $ceksetelah->tanggal;
                    $diff = abs($tanggal1 - $tanggal2)/60/60/24;
                    $counter = 0;
                    for ($x = 0; $x < $diff; $x++) {
                        $tanggalcek = date('Y-m-d', strtotime($tanggalcek .' -1 day'));
                        echo $tanggalcek;
                        $cekhari = strtotime($tanggalcek);
                        $day = date('l', $cekhari);
                        echo $day;
                        if($day != "Saturday" && $day != "Sunday")
                        {
                            $counter++;
                        }
                    } 
                    $counter--;
                    $nomorbaru = $ceksetelah->nomor - $data->nomor -(10*$counter);


                    if($nomorbaru == 1)
                    {
                        $cekhuruf = nomor_surat::findFirst(
                            [
                                'conditions' => 'huruf IS NOT NULL AND tanggal = :tanggal:',
                                'bind' => [
                                    'tanggal' => $tanggal,
                                ],
                                'order' => 'huruf DESC',
                                'limit' => 1,
                                
                            ]
                        );
                        if($cekhuruf)
                        {
                            
                            $huruf = ($cekhuruf->huruf) + 1;
                            $nomorterpakai = ($data->nomor).chr($huruf);

                        }
                        else
                        {
                            $huruf = 97;
                            $nomorterpakai = $data->nomor.chr($huruf);

                        }

                        $pakaihuruf = true;
                        $nomor = $data->nomor;
                    }
                    else
                    {
                        $nomor = $data->nomor + 1;
                    }

                }
                else
                {
                    $nomor = $data->nomor + 1;
                }

            }
            else
            {
                $ceksetelah = nomor_surat::findFirst(
                    [
                        "tanggal>'$tanggal'",
                        'order' => 'id ASC',
                        'limit' => 1,
                    ]
                );
                if($ceksetelah)
                {
                    // echo("ada tanggal setelah"); die();
                    // $tanggal1 = strtotime($tanggal);
                    // $tanggal2 = strtotime($ceksetelah->tanggal);
                    // $diff = abs($tanggal2 - $tanggal1)/60/60/24;
                    // $nomor = $ceksetelah->nomor - (10*$counter);
                    // $nomor = $ceksebelum->nomor + (10*$counter) + 1;

                    $tanggal1 = strtotime($tanggal);
                    $tanggal2 = strtotime($ceksetelah->tanggal);
                    $tanggalcek = $ceksetelah->tanggal;
                    $diff = abs($tanggal1 - $tanggal2)/60/60/24;
                    $counter = 0;
                    for ($x = 0; $x < $diff; $x++) {
                        $tanggalcek = date('Y-m-d', strtotime($tanggalcek .' -1 day'));
                        echo $tanggalcek;
                        $cekhari = strtotime($tanggalcek);
                        $day = date('l', $cekhari);
                        echo $day;
                        if($day != "Saturday" && $day != "Sunday")
                        {
                            $counter++;
                        }
                    } 

                    $nomor = $ceksetelah->nomor - (10*$counter);

                }
                else
                {
                    
                    $ceksebelum = nomor_surat::findFirst(
                        [
                            "tanggal<'$tanggal'",
                            'order' => 'id DESC',
                            'limit' => 1,
                        ]
                    );
                    if($ceksebelum)
                    {
                        $tanggal1 = strtotime($tanggal);
                        $tanggal2 = strtotime($ceksebelum->tanggal);
                        $tanggalcek = $ceksebelum->tanggal;
                        $diff = abs($tanggal1 - $tanggal2)/60/60/24;
                        $counter = 0;
                        for ($x = 0; $x < $diff; $x++) {
                            $tanggalcek = date('Y-m-d', strtotime($tanggalcek .' +1 day'));
                            echo $tanggalcek;
                            $cekhari = strtotime($tanggalcek);
                            $day = date('l', $cekhari);
                            echo $day;
                            if($day != "Saturday" && $day != "Sunday")
                            {
                                $counter++;
                            }
                        } 
                        echo $counter;
                        // die();
                        $nomor = $ceksebelum->nomor + (10*$counter) + 1;
                    }
                    else{
                        $nomor=1;
                    }

                }

            }
            if($ttd == 1)
            {
                $ttd_oleh = "R5W-5M470000";

            }
            else
            {
                $ttd_oleh = "R5W-5N470000";
            }

            if($pakaihuruf)
            {
                $nomorsurat = "TEL.".($nomorterpakai)."/".$kodesurat->kode_surat."/".$ttd_oleh."/2020";

            }
            else{
                $nomorsurat = "TEL.".($nomor)."/".$kodesurat->kode_surat."/".$ttd_oleh."/2020";
            }

            if($nomor <= 0)
            {   
                $this->response->redirect('surat/dateerror');
            }

            else{
                $surat = new nomor_surat();
                $surat->name = $this->request->getPost('nama');
                $surat->id_user = $this->session->get('user')['id'];
                $surat->nama_surat = $this->request->getPost('namasurat');
                $surat->jenis_surat = $jenissurat;
                $surat->nomor = $nomor;
                $surat->no_surat = $nomorsurat;
                $surat->customer = $this->request->getPost('customer');
                $surat->pengecekan = 0;
                $surat->deleted = 0;
                $surat->tanggal = $this->request->getPost('tanggal');
                if($pakaihuruf)
                {
                    $surat->huruf=$huruf;
                }
                // var_dump($surat); die();
                $surat->save();
                $this->response->redirect('surat/nomor');
            }
        }

    }

    public function listsuratAction()
    {
        $id = $this->session->get('user')['id'];
        $surats = nomor_surat::find([
            "id_user='$id'",
            'order' => 'nomor DESC'
            ]);
        $data = array();

        foreach ($surats as $surat) {

            $jenis = jenis_surat::findFirst([
                "id='$surat->jenis_surat'"
                ]);

            // if($surat->jenis_surat == 1)
            // {
            //     $jenissurat = "Berita Acara Penjelasan";
            // }
            // elseif($surat->jenis_surat == 2)
            // {
            //     $jenissurat = "BASO";
            // }
            // elseif($surat->jenis_surat == 3)
            // {
            //     $jenissurat = "BADO";
            // }
            // elseif($surat->jenis_surat == 4)
            // {
            //     $jenissurat = "Surat Keluar";
            // }
            // elseif($surat->jenis_surat == 5)
            // {
            //     $jenissurat = "P0/P1";
            // }
            // elseif($surat->jenis_surat == 6)
            // {
            //     $jenissurat = "Surat Penawaran";
            // }

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
                'customer' => $surat->customer,
                'jenis_surat' => $jenis->nama_surat,
                'status' => $status,
                'link' => $surat->id,
            );

        }
        
        $content = json_encode($data);
        return $this->response->setContent($content);
    }

    public function uploadAction($id)
    {
        $_isAdmin = $this->session->get('admin')['tipe'];
        $_isUser = $this->session->get('user')['tipe'];
        // if ($_isAdmin == 1) {
        //     $this->response->redirect('admin/list');
        // }
        if(!$_isUser && !$_isAdmin)
        {
            $this->response->redirect('user/login');
        }
        
        $data = nomor_surat::findFirst("id='$id'");

        $this->view->data = $data;

        

    }

    public function storeuploadAction()
    {
        $id = $this->request->getPost('id');
        $val2 = new FileValidation();
        $messages2 = $val2->validate($_FILES);
        if (count($messages2)) {
			$this->flashSession->error("GAGAL UPLOAD. Pastikan format file .pdf dan ukuran tidak melebihi 5 MB");
            return $this->response->redirect('surat/upload' . '/' . $id);
        }
        else
        {         
            $surat = nomor_surat::findFirst("id='$id'");
            $penomoran = (explode('/',$surat->no_surat,4));
            $nomorsaja = (explode('.',$penomoran[0],2));
            if (true == $this->request->hasFiles() && $this->request->isPost()) {
                $upload_dir = __DIR__ . '/../../public/uploads/';
          
                if (!is_dir($upload_dir)) {
                  mkdir($upload_dir, 0755);
                }
                foreach ($this->request->getUploadedFiles() as $file) {
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $file->moveTo($upload_dir . $file->getName());
                    $lama = $upload_dir.$file->getName();
                    $baru = $upload_dir.$nomorsaja[0].$nomorsaja[1].'-'.$penomoran[1].'-'.$penomoran[2].'-'.$penomoran[3].'.'.end($temp);
                    rename($lama, $baru); 
                }
            }

            $surat->nama_pengupload = $this->session->get('user')['username'];
            $surat->file = $nomorsaja[0].$nomorsaja[1].'-'.$penomoran[1].'-'.$penomoran[2].'-'.$penomoran[3].'.'.end($temp);
    
            $surat->save();

            $this->response->redirect('surat/list');
        }
        
    }

    public function downloadAction($id)
    { 
        $surat = nomor_surat::findFirst("id='$id'");
        
            if($surat->file)
            {
                $upload_dir = __DIR__ . '/../../public/uploads/';
                $path = $upload_dir.$surat->file;
                $filetype = filetype($path);
                $filesize = filesize($path);
                // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                // header('Content-Description: File Download');
                header('Content-type: '.$filetype);
                header('Content-length: ' . $filesize);
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                header('Content-Disposition: attachment; filename="'.$surat->file.'"');
                readfile($path);

            }
            else
            {
                return $this->response->redirect('surat/list');
            }
        
        
     }
     public function datadaftarsuratAction()
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
            
            $data[] = array(
                'no_surat' => $surat->no_surat,
                'tanggal' => $surat->tanggal,
                'nama_surat' => $surat->nama_surat,
                'customer' => $surat->customer,
                'jenis_surat' => $jenissurat->nama_surat,
                'pembuat' => $surat->name,
                'status' => $status,
            );
        }
        
        $content = json_encode($data);
        return $this->response->setContent($content);
     }

     public function daftarsuratAction()
     {
        $_isUser = $this->session->get('user');

        // if ($_isAdmin) 
        // {
        //     $this->response->redirect('admin/list');
        // }
        if (!$_isUser)
        {
            $this->response->redirect('user/login');
        }

     }

     public function dateerrorAction()
    {

    }
    
}