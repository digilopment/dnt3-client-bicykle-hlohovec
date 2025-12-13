<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\ArticleList;
use DntLibrary\Base\ArticleView;
use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Image;

class ArticleListPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;
    protected $finalItems = [];

    protected $hasPosts;

    protected $articleList;

    protected $articleView;

    protected $image;

    protected $db;

    protected $dnt;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->hasPosts = 0;
        $this->finalItems = [];
        $this->articleList = new ArticleList();
        $this->articleView = new ArticleView();
        $this->image = new Image();
        $this->db = new DB();
        $this->dnt = new Dnt();
        $this->pluginId = $pluginId;
    }

    protected function finalItems()
    {
        $query = $this->articleList->query();
        if ($this->db->num_rows($query) > 0) {
            $this->hasPosts = 1;
            $i = 0;
            foreach ($this->db->get_results($query) as $row) {
                if ($row['show'] == 1) {
                    $this->finalItems[$i]['content'] = $row['content'];
                    $this->finalItems[$i]['datetime_publish'] = $row['datetime_publish'];
                    $this->finalItems[$i]['perex'] = $row['perex'];
                    $this->finalItems[$i]['name'] = $row['name'];
                    $this->finalItems[$i]['img'] = $this->image->getPostImage($row['id'], "dnt_posts", IMAGE::SMALL);
                    $this->finalItems[$i]['url'] = $this->articleView->detailUrl($row['cat_name_url'], $row['id'], $row['name_url']);
                    $i++;
                }
            }
        }
        /*if (is_array($this->finalItems)) {
            $this->finalItems = $this->dnt->orderby($this->finalItems, 'datetime_publish', 'desc');
        }*/
    }

    public function init()
    {
        $this->finalItems();
    }

    public function run()
    {
        $data = $this->data;
        $data['items'] = $this->finalItems;
        $data['hasPosts'] = $this->hasPosts;
        $this->layout($this->loc, 'tpl', $data);
    }

}
