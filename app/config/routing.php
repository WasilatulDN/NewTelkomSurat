<?php

$di->set(
    'router',
    function () {
        $router = new \Phalcon\Mvc\Router(false);

        $router->mount(
            new AdminRoutes()
        );

        $router->mount(
            new SuratRoutes()
        );

        $router->mount(
            new UserRoutes()
        );

        $router->addGet(
            '/',
            [
                'controller' => 'index',
                'action' => 'index'
            ]
        );

        $router->addGet(
            '/awal',
            [
                'controller' => 'index',
                'action' => 'awal'
            ]
        );

        $router->notFound([
            'controller' => 'index',
            'action' => 'show404'
        ]);
        
        return $router;
    }
);