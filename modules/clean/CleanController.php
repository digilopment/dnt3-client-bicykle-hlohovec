<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Data;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Rest;

class CleanController extends BaseController
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
        $data['content'] = $data['article']['content'];

        if ($this->rest->webhook(2)) {
            $this->dnt->redirect(WWW_PATH . '404');
        } else {
            $this->modulConfigurator($data);
        }
    }

}
