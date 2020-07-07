<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Rest;

class GalleryPluginControll extends Plugin
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

    private function preparePostsQuery($data)
    {
        $GALLERY = explode(",", $data['meta_tree']['keys']['gallery']['value']);
        $this->hasItems = count($GALLERY);
        if ($this->hasItems > 0) {
            $this->items = $GALLERY;
        } else {
            $this->items = false;
        }
    }

    public function run()
    {
        $data = $this->data;
        $this->preparePostsQuery($data);
        $data['hasItems'] = $this->hasItems;
        $data['items'] = $this->items;
        $this->layout($this->loc, 'tpl', $data);
    }

}
