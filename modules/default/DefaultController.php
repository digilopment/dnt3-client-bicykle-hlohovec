<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Data;
use DntLibrary\Base\Settings;

class DefaultController extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        $this->frontendData = new Data();
    }

    protected function setTitle()
    {
        return $this->modulPostData->name . ' | ' . $this->settings->get('title');
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

    public function run()
    {
        $this->data();
        $data = $this->data;
        $this->modulConfigurator($data, 'default');
    }

}
