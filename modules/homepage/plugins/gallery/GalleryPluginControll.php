<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Image;

class GalleryPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;
    protected $items = false;

    protected $image;

    protected $hasItems;

    protected $finalItems;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->image = new Image();
    }

    private function preparePostsQuery($data)
    {
        $galleryIds = explode(',', $data['meta_tree']['keys']['gallery']['value']);
        $this->hasItems = count($galleryIds);
        if ($this->hasItems > 0) {
            $final = [];
            foreach ($galleryIds as $key => $item) {
                $final[$key]['id'] = $item;
                $final[$key]['image'] = $this->image->getFileImage($item, true, Image::LARGE);
            }
            $this->finalItems = $final;
        }
    }

    public function run()
    {
        $data = $this->data;
        $this->preparePostsQuery($data);
        $data['hasItems'] = $this->hasItems;
        $data['items'] = $this->finalItems;
        $this->layout($this->loc, 'tpl', $data);
    }

}
