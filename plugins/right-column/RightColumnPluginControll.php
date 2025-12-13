<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\ArticleView;
use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Image;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;

class RightColumnPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;

    protected $rest;

    protected $multilanguage;

    protected $settings;

    protected $db;

    protected $article;

    protected $image;

    protected $dnt;

    protected $postsModel;

    protected $finalItems;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->rest = new Rest();
        $this->multilanguage = new MultyLanguage();
        $this->settings = new Settings();
        $this->db = new DB();
        $this->article = new ArticleView();
        $this->image = new Image();
        $this->dnt = new Dnt();
    }

    protected function postsModel()
    {
        $catId = 1156;
        $this->postsModel = $this->article->getPosts($catId, false, "`order` DESC");
    }

    protected function prepareItems()
    {
        $final = [];
        foreach ($this->postsModel as $key => $item) {
           if($item['show'] >= 0 && $item['show'] <= 2){
				$final[$key] = $item;
				$final[$key]['image'] = $this->image->getPostImage($item['id_entity'], null, Image::MEDIUM);
				$final[$key]['is_external_url'] = ($this->dnt->is_external_url($item['name_url'])) ? 1 : 0;
				$final[$key]['perex_not_html'] = $this->dnt->not_html($item['perex']);
				$final[$key]['content_not_html'] = $this->dnt->not_html($item['content']);
			}
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
        $data['translate'] = function ($key) use($data) {
            return $this->multilanguage->translate($data, $key, 'translate');
        };
        $data['getModulUrl'] = function ($key) {
            return $this->rest->getModulUrl($key);
        };
        $data['logo_firmy'] = $this->settings->getImage($data['meta_settings']['keys']['logo_firmy']['value']);
        $data['logo_firmy_2'] = $this->settings->getImage($data['meta_settings']['keys']['logo_firmy_2']['value']);
        $data['logo_firmy_3'] = $this->settings->getImage($data['meta_settings']['keys']['logo_firmy_3']['value']);
        $data['items'] = $this->finalItems;
        $this->layout($this->loc, 'tpl', $data);
    }

}
