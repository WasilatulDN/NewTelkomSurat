<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use App\Validation\FileValidation;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->datas = jenis_surat::find();
        
    }

    public function show404Action()
    {
        
    }
    
}