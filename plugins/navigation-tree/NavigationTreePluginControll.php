<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Categories;
use DntLibrary\App\Plugin;
use DntLibrary\Base\Rest;

class NavigationTreePluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;
    protected $categories;

    protected $rest;

    public function __construct($data, $pluginId, $plugin)
    {
        parent::__construct($data, $pluginId, $plugin);
        $this->data = $data;
        $pluginName = isset($plugin['name']) ? $plugin['name'] : false;
        $this->data['ENV'] = $this->envDriver($data, $pluginId, $pluginName);
        $this->pluginId = $pluginId;
        $this->categories = new Categories();
        $this->rest = new Rest();
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
        $data['aggrBuilder'] = function() {
            return false; //DISABLE - PO SPUSTENI PRIDAT DO Plugins.shell configu <VAR id="cache_id" value="GET{aggrBuilder}" />
            $aggrBuilder = $this->rest->get('aggrBuilder');
            if ($aggrBuilder) {
                return '?aggrBuilder=' . $aggrBuilder;
            }
            return false;
        };
        //var_dump($this->data['ENV']->template);
        $this->layout($this->loc, $this->data['ENV']->template, $data);
    }

}
