<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\Settings;

class HomepageController extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings;
        $this->frontend = new Frontend();
    }

    protected function setTitle()
    {
        return $this->modulPostData->name . ' | ' . $this->settings->get('title');
    }

    protected function data()
    {
        $this->data = $this->frontend->get();
    }

    protected function init()
    {
        $this->data = $this->frontend->get();
    }

    public function run()
    {
        $this->init();
        $data = $this->data;
        $this->modulConfigurator($data);
    }

}
