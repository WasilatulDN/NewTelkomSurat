<?php
namespace App\Events;

use Phalcon\Mvc\Controller;

class AdminProtectController extends Controller
{
    public function beforeExecuteRoute()
    {
        if(!$this->session->has('admin')){
            return $this->response->redirect();
        }
    }
    protected function back() {
        return $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}