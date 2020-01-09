<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class UserRoutes extends RouterGroup{
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
}