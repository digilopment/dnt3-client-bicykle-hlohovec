<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;

class TopPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
    }

    public function run()
    {
        $data = $this->data;
        $this->layout($this->loc, 'tpl', $data);
    }

}
