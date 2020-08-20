<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\App\Post;
use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Image;
use DntLibrary\Base\Vendor;

class DoubleSliderPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->posts = new Post();
        $this->vendor = new Vendor();
        $this->db = new DB();
        $this->image = new Image();
        $this->dnt = new Dnt();
    }

    protected function postsModel()
    {
        $id = (int) $this->env('post_cat_id');
        $query = "SELECT * FROM dnt_posts WHERE type = 'post' AND cat_id = '" . $id . "' AND `show` > 0 AND `vendor_id` = '" . $this->vendor->getId() . "'";
        if ($this->db->num_rows($query) > 0) {
            $this->postsModel = $this->db->get_results($query);
        }
    }

    protected function prepareItems()
    {
        $final = [];
        foreach ($this->postsModel as $key => $item) {
            $final[$key] = $item;
            $final[$key]['image'] = $this->image->getPostImage($item['id_entity'], null, Image::MEDIUM);
            $final[$key]['is_external_url'] = ($this->dnt->is_external_url($item['name_url'])) ? 1 : 0;
            $final[$key]['perex_not_html'] = $this->dnt->not_html($item['perex']);
            $final[$key]['content_not_html'] = $this->dnt->not_html($item['content']);
        }
        $this->finalItems = $final;
    }

    public function init()
    {
        $this->postsModel();
        $this->prepareItems();
    }

    public function run()
    {
        $data = $this->data;
        $data['items'] = $this->finalItems;
        $data['plugin_id'] = $this->pluginId;
        $this->layout($this->loc, 'tpl', $data);
    }

}
