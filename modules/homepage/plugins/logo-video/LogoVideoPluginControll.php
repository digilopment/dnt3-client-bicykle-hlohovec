<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Settings;

class LogoVideoPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->settings = new Settings();
    }

    public function run()
    {
        $data = $this->data;
        $data['logo_firmy'] = $this->settings->getImage($data['meta_settings']['keys']['logo_firmy']['value']);
        $data['video_id'] = 15021;
        $this->layout($this->loc, 'tpl', $data);
    }

}
