<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\MultyLanguage;

class ContactPluginControll extends Plugin
{

    protected $loc = __FILE__;

    public function __construct($data, $pluginId, $plugin)
    {
        $this->multilanguage = new MultyLanguage;
        $this->frontend = new Frontend();
        $this->dnt = new Dnt();
        parent::__construct($data, $pluginId, $plugin);
        $this->data = $data;
    }

    public function run()
    {
        $data = $this->data;
        $data['translate'] = function($translateKey) {
            return $this->multilanguage->translate($this->data, $translateKey, 'translate');
        };
        $data['setting'] = function($key) {
            return $this->frontend->getMetaSetting($this->data, $key);
        };
        $data['googleMaps'] = function($url) {
            return $this->dnt->getMapLocation($url);
        };
        $this->layout($this->loc, 'tpl', $data);
    }

}
