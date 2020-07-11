<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Data;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Rest;

class RpcController extends BaseController
{

    public function __construct()
    {
        $this->rest = new Rest();
        $this->frontendData = new Data();
        $this->dnt = new Dnt();
    }

    protected function data()
    {
        $config = [
            'sitemap_items' => true,
            'menu_items' => true,
            'translates' => true,
            'meta_settings' => true,
        ];
        $this->frontendData->configure($config);
        $this->data = $this->frontendData->get();
    }

    public function init()
    {
        $this->data();
    }

    public function run()
    {
        $this->init();
        $data = $this->data;
        if ($this->rest->webhook(2) == 'json' && $this->rest->webhook(3) == 'contact-form') {
            $this->modulConfigurator($data, 'rpc');
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
