<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class SuratRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPaths([
            'controller' => 'surat',
        ]);

        $this->setPrefix('/surat');
        
        $router->addGet(
            '/list',
            [
                'controller' => 'index',
                'action' => 'detailnomor'
            ]
        );

        $router->addGet(
            '/nomor',
            [
                'controller' => 'index',
                'action' => 'nomor'
            ]
        );

        $router->addPost(
            '/store',
            [
                'controller' => 'index',
                'action' => 'storesurat'
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
        
    }
}