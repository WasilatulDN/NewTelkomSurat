<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use App\Validation\FileValidation;

class UserController extends Controller{

    public function storeregisterAction(){

	    $user = new user();
	    $user->username = $this->request->getPost('username');
	    $password = $this->request->getPost('password');
	    $user->password = $this->security->hash($password);
	    $usernames = admin::findFirst("username = '$user->username'");
	    if($usernames){
	        $this->flashSession->error("Gagal register. Username telah digunakan.");
	        return $this->response->redirect('awal');
	    }
	    else{

	        $user->save();
            $this->response->redirect('awal');
	    }
	}

	public function storeloginAction()
    {
        $username = $this->request->getPost('username');
        $pass = $this->request->getPost('password');
        // echo $pass;
        // die();
        if($this->request->getPost('tipe')=="admin")
        {
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
	                        'tipe' => '1'
	                    ]
	                );

	                (new Response())->redirect('admin/list')->send();
	            }
	            else{
	                $this->flashSession->error("Gagal masuk sebagai admin. Silakan cek kembali username dan password anda.");
	                $this->response->redirect('user/login');
	            }
	        }
	        else{
	            $this->flashSession->error("Gagal masuk sebagai admin. Silakan cek kembali username dan password anda.");
	                $this->response->redirect('user/login');
	        }
        }

        elseif($this->request->getPost('tipe')=="user")
        {
	        $user = user::findFirst("username = '$username'");
	        // echo $user->password;
	        // die();
	        if ($user){
	            if($this->security->checkHash($pass, $user->password)){
	                $this->session->set(
	                    'user',
	                    [
	                        'id' => $user->id,
	                        'username' => $user->username,
	                        'tipe' => '2',
	                    ]
	                );

	                (new Response())->redirect('admin/list')->send();
	            }
	            else{
	                $this->flashSession->error("Gagal masuk sebagai user. Silakan cek kembali username dan password anda.");
	                $this->response->redirect('user/login');
	            }
	        }
	        else{
	            $this->flashSession->error("Gagal masuk sebagai user. Silakan cek kembali username dan password anda.");
	                $this->response->redirect('user/login');
	        }
        }

    }

    public function loginAction()
    {

	}
	
	public function registerAction()
    {

    }
}