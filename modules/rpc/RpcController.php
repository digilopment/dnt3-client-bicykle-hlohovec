<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\Rest;

class RpcController extends BaseController
{

    public function __construct()
    {
        $this->rest = new Rest();
        $this->frontend = new Frontend();
        $this->dnt = new Dnt();
    }

    protected function data()
    {
        $this->data = $this->frontend->get();
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
