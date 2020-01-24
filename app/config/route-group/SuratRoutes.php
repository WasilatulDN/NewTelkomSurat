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
        
        $this->addGet(
            '/list',
            [
                'controller' => 'surat',
                'action' => 'list'
            ]
        );

        $this->addGet(
            '/nomor',
            [
                'controller' => 'surat',
                'action' => 'nomor'
            ]
        );

        $this->addGet(
            '/weekend',
            [
                'controller' => 'surat',
                'action' => 'weekend'
            ]
        );

        $this->addPost(
            '/store',
            [
                'controller' => 'surat',
                'action' => 'generatesurat'
            ]
        );

        $this->addGet(
            '/listsurat',
            [
                'controller' => 'surat',
                'action' => 'listsurat'
            ]
        );

        $this->addGet(
            '/upload/{id}',
            [
                'controller' => 'surat',
                'action' => 'upload'
            ]
        );

        $this->addGet(
            '/download/{id}',
            [
                'controller' => 'surat',
                'action' => 'download'
            ]
        );

        $this->addPost(
            '/storeupload',
            [
                'controller' => 'surat',
                'action' => 'storeupload'
            ]
        );
        $this->addGet(
            '/daftarsurat',
            [
                'controller' => 'surat',
                'action' => 'daftarsurat'
            ]
        );
        $this->addGet(
            '/datadaftarsurat',
            [
                'controller' => 'surat',
                'action' => 'datadaftarsurat'
            ]
        );

        $this->addGet(
            '/dateerror',
            [
                'controller' => 'surat',
                'action' => 'dateerror'
            ]
        );
        
    }
}