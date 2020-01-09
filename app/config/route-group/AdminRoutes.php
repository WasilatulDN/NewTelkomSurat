<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class AdminRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPaths([
            'controller' => 'admin',
        ]);

        $this->setPrefix('/admin');

        $this->addGet(
            '/register',
            [
                'controller' => 'admin',
                'action' => 'register'
            ]
        );

        $this->addPost(
            '/register',
            [
                'controller' => 'admin',
                'action' => 'storeregister'
            ]
        );

        $this->addPost(
            '/login',
            [
                'controller'=>'admin',
                'action'=>'storelogin'
            ]
        );

        $this->addGet(
            '/login',
            [
                'controller' => 'admin',
                'action' => 'login'
            ]
        );

        $this->addGet(
            '/logout',
            [
                'controller' => 'admin',
                'action' => 'logout'
            ]
        );

        $this->addGet(
            '/listsurat',
            [
                'controller' => 'admin',
                'action' => 'listsurat'
            ]
        );

        $this->addGet(
            '/detail/{id}',
            [
                'controller' => 'admin',
                'action' => 'detail'
            ]
        );

        $this->addGet(
            '/verifikasi/{id}',
            [
                'controller' => 'admin',
                'action' => 'verifikasi'
            ]
        );

        $this->addGet(
            '/tolak/{id}',
            [
                'controller' => 'admin',
                'action' => 'tolak'
            ]
        );

        $this->addGet(
            '/urungkan/{id}',
            [
                'controller' => 'admin',
                'action' => 'urungkan'
            ]
        );

        $this->addGet(
            '/list',
            [
                'controller' => 'admin',
                'action' => 'list'
            ]
        );

        $this->addGet(
            '/export',
            [
                'controller' => 'admin',
                'action' => 'export'
            ]
        );


        $this->addGet(
            '/exportsudah',
            [
                'controller' => 'admin',
                'action' => 'exportSudah'
            ]
        );
        
        $this->addGet(
            '/exportbelum',
            [
                'controller' => 'admin',
                'action' => 'exportBelum'
            ]
        );

        $this->addGet(
            '/jenissurat',
            [
                'controller' => 'admin',
                'action' => 'jenissurat'
            ]
        );

        $this->addGet(
            '/formjenissurat',
            [
                'controller' => 'admin',
                'action' => 'formjenissurat'
            ]
        );

        $this->addGet(
            '/verif',
            [
                'controller' => 'admin',
                'action' => 'verif'
            ]
        );



        $this->addGet(
            '/listjenissurat',
            [
                'controller' => 'admin',
                'action' => 'listjenissurat'
            ]
        );

        $this->addGet(
            '/listjenis',
            [
                'controller' => 'admin',
                'action' => 'listjenis'
            ]
        );

        $this->addGet(
            '/listuser',
            [
                'controller' => 'admin',
                'action' => 'listuser'
            ]
        );

        $this->addGet(
            '/listuserview/{id}',
            [
                'controller' => 'admin',
                'action' => 'listuserview'
            ]
        );

        $this->addGet(
            '/verifdetail/{id}',
            [
                'controller' => 'admin',
                'action' => 'verifdetail'
            ]
        );
        $this->addGet(
            '/verifikasiuser/{id}',
            [
                'controller' => 'admin',
                'action' => 'verifikasiuser'
            ]
        );

        $this->addGet(
            '/resetpass',
            [
                'controller' => 'admin',
                'action' => 'resetpass'
            ]
        );
    }
}