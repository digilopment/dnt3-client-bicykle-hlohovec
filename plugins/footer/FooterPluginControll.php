<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Rest;

class FooterPluginControll extends Plugin
{

    protected $loc = __FILE__;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->rest = new Rest();
        $this->multiLanguage = new MultyLanguage();
    }

    public function run()
    {
        $data = $this->data;
        $data['translate'] = function ($key) use($data) {
            return $this->multiLanguage->translate($data, $key, 'translate');
        };
        $data['getModulUrl'] = function ($key) {
            return $this->rest->getModulUrl($key);
        };
        $this->layout($this->loc, 'tpl', $data);
    }

}
