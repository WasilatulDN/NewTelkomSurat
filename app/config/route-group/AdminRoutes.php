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

        $router->addGet(
            '/register',
            [
                'controller' => 'index',
                'action' => 'create'
            ]
        );

        $router->addPost(
            '/register',
            [
                'controller' => 'index',
                'action' => 'store'
            ]
        );

        $router->addPost(
            '/login',
            [
                'controller'=>'index',
                'action'=>'storelogin'
            ]
        );

        $router->addGet(
            '/login',
            [
                'controller' => 'index',
                'action' => 'loginadmin'
            ]
        );

        $router->addGet(
            '/logout',
            [
                'controller' => 'index',
                'action' => 'logout'
            ]
        );

        $router->addGet(
            '/listsurat',
            [
                'controller' => 'index',
                'action' => 'listsuratadmin'
            ]
        );

        $router->addGet(
            '/detail/{id}',
            [
                'controller' => 'index',
                'action' => 'lihatdetail'
            ]
        );

        $router->addGet(
            '/list',
            [
                'controller' => 'index',
                'action' => 'halamanadmin'
            ]
        );
        
    }
}