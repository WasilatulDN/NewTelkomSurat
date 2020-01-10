<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use App\Validation\FileValidation;

class IndexController extends Controller
{
    public function indexAction()
    {
        $_isAdmin = $this->session->get('admin')['tipe'];
        $_isUser = $this->session->get('user')['tipe'];
        if ($_isAdmin == 1) {
            $this->response->redirect('admin/list');
        }
        if(!$_isUser && !$_isAdmin)
        {
            $this->response->redirect('user/login');
        }
        $this->view->datas = jenis_surat::find();
    }

    public function show404Action()
    {
        
    }
    
}