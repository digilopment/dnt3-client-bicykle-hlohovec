<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Settings;

class NavigationPluginControll extends Plugin
{

    protected $loc = __FILE__;

    protected $pluginId;

    protected $settings;

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
        $data['logo_firmy_2'] = $this->settings->getImage($data['meta_settings']['keys']['logo_firmy_2']['value']);
        $data['logo_firmy_3'] = $this->settings->getImage($data['meta_settings']['keys']['logo_firmy_3']['value']);
        $data['plugin_id'] = $this->pluginId;
        $this->layout($this->loc, 'tpl', $data);
    }

}
