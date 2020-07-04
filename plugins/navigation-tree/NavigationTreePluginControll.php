<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Categories;
use DntLibrary\App\Plugin;

class NavigationTreePluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;
    protected $categories;

    public function __construct($data, $pluginId, $plugin)
    {
        parent::__construct($data, $pluginId, $plugin);
        $this->data = $data;
        $pluginName = isset($plugin['name']) ? $plugin['name'] : false;
        $this->data['ENV'] = $this->envDriver($data, $pluginId, $pluginName);
        $this->pluginId = $pluginId;
        $this->categories = new Categories();
    }

    public function init()
    {
        $this->categories->init();
    }

    public function run()
    {
        $data = $this->data;
        $data['categoryElement'] = function($id) {
            return $this->categories->getElement($id);
        };
        $data['hasChild'] = function($parentId) {
            return $this->categories->hasChild($parentId) ? true : false;
        };
        $data['getChildren'] = function($parentId) {
            return $this->categories->getChildren($parentId);
        };

        $data['getParentElements'] = function($id) {
            return $this->categories->getParentElements($id);
        };
        //var_dump($this->data['ENV']->template);
        $this->layout($this->loc, $this->data['ENV']->template, $data);
    }

}
