<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\Rest;

class CleanController extends BaseController
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
        $data['content'] = $data['article']['content'];

        if ($this->rest->webhook(2)) {
            $this->dnt->redirect(WWW_PATH . '404');
        } else {
            $this->modulConfigurator($data);
        }
    }

}
