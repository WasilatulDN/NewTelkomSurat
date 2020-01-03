<?php

$di->set(
    'router',
    function () {
        $router = new \Phalcon\Mvc\Router(false);

        // $router->mount(
        //     new UserRoutes()
        // );

        $router->addGet(
            '/',
            [
                'controller' => 'index',
                'action' => 'index'
            ]
        );
        $router->addGet(
            '/carinomor',
            [
                'controller' => 'index',
                'action' => 'carinomor'
            ]
        );
        $router->addGet(
            '/detailnomor',
            [
                'controller' => 'index',
                'action' => 'detailnomor'
            ]
        );
        $router->addGet(
            '/loginadmin',
            [
                'controller' => 'index',
                'action' => 'loginadmin'
            ]
        );

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

        $router->addGet(
            '/nomor',
            [
                'controller' => 'index',
                'action' => 'nomor'
            ]
        );
        
        $router->addGet(
            '/halamanadmin',
            [
                'controller' => 'index',
                'action' => 'halamanadmin'
            ]
        );


        $router->addGet(
            '/lihatdetail/{id}',
            [
                'controller' => 'index',
                'action' => 'lihatdetail'
            ]
        );



        // $router->addGet(
        //     '/register',
        //     [
        //         'controller' => 'index',
        //         'action' => 'register'
        //     ]
        // );


        // $router->addGet(
        //     '/adminverifikasi',
        //     [
        //         'controller' => 'index',
        //         'action' => 'adminverifikasi'
        //     ]
        // );


        $router->addPost(
            '/storelogin',
            [
                'controller'=>'index',
                'action'=>'storelogin'
            ]

        );

        $router->addPost(
            '/storesurat',
            [
                'controller' => 'index',
                'action' => 'storesurat'
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
                'action' => 'listsurat'
            ]
        );

        $router->addGet(
            '/listsuratadmin',
            [
                'controller' => 'index',
                'action' => 'listsuratadmin'
            ]
        );

        $router->addGet(
            '/upload/{id}',
            [
                'controller' => 'index',
                'action' => 'upload'
            ]
        );

        $router->addGet(
            '/download/{id}',
            [
                'controller' => 'index',
                'action' => 'download'
            ]
        );

        $router->addPost(
            '/storeupload',
            [
                'controller' => 'index',
                'action' => 'storeupload'
            ]
        );

        $router->addGet(
            '/nomorterpakai',
            [
                'controller' => 'index',
                'action' => 'nomorterpakai'
            ]
        );

        $router->notFound([
            'controller' => 'index',
            'action' => 'show404'
        ]);
        
        return $router;
    }
);