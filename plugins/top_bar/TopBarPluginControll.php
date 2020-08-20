<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Settings;
use DntLibrary\Base\Webhook;

class TopBarPluginControll extends Plugin
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
        $this->webhook = new Webhook();
        $this->multilanguage = new MultyLanguage();
    }

    public function run()
    {
        $data = $this->data;
        $data['search_url'] = WWW_PATH . $this->webhook->getSitemapModules('product_list')[0] . '/products/search';
        $data['translate'] = function ($key) use($data) {
            return $this->multilanguage->translate($data, $key, 'translate');
        };
        $this->layout($this->loc, 'tpl', $data);
    }

}
