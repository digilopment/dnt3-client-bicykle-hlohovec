<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\DB;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Url;
use DntLibrary\Base\Vendor;

class PostsPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->db = new DB();
        $this->multilanguage = new MultyLanguage();
        $this->url = new Url();
    }

    private function preparePostsQuery()
    {
        $catId = 304;
        $query = "SELECT * FROM dnt_posts WHERE type = 'post' AND cat_id = '" . $catId . "' AND vendor_id = '" . Vendor::getId() . "' AND `show` > 0";
        $this->hasItems = $this->db->num_rows($query);
        if ($this->hasItems > 0) {
            $this->items = $this->db->get_results($query);
        } else {
            $this->items = false;
        }
    }

    public function run()
    {
        $this->preparePostsQuery();
        $data = $this->data;
        $data['hasItems'] = $this->hasItems;
        $data['items'] = $this->items;
        $data['translate'] = function ($key) use($data) {
            return $this->multilanguage->translate($data, $key, 'translate');
        };
        $data['urlFormat'] = function ($nameUrl) {
            return $this->url->getPostUrl($nameUrl);
        };
        $this->layout($this->loc, 'tpl', $data);
    }

}
