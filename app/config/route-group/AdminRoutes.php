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
            '/list',
            [
                'controller' => 'admin',
                'action' => 'list'
            ]
        );
        
    }
}