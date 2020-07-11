<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Data;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;

class ArticleListController extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        $this->frontendData = new Data;
        $this->rest = new Rest();
        $this->dnt = new Dnt();
    }

    protected function setTitle()
    {
        return $this->modulPostData->name . ' | ' . $this->settings->get('title');
    }

    protected function data()
    {
        $config = [
            'sitemap_items' => true,
            'menu_items' => true,
            'translates' => true,
            'meta_settings' => true,
        ];
        $this->frontendData->configure($config);
        $this->data = $this->frontendData->get();
    }

    protected function webhook($key)
    {
        return isset($this->data['webhook'][$key]) ? $this->data['webhook'][$key] : false;
    }

    protected function modulPostData()
    {
        $nameUrl = $this->webhook(1);
        foreach ($this->data['sitemap_items'] as $item) {
            if ($item['name_url'] == $nameUrl) {
                $this->modulPostData = (object) $item;
            }
        }
    }

    protected function customData()
    {
        $image = $this->data['article']['img'];
        $description = $this->data['meta_settings']['keys']['description']['value'];
        $title = $this->setTitle();
        $customData = [
            'title' => $this->setTitle(),
            'meta' => [
                '<meta content="' . $title . '" property="og:title" />',
                '<meta content="' . $this->data['title'] . '" property="og:site_name" />',
                '<meta content="' . $image . '" property="og:image" />',
                '<meta name="description" content="' . $description . '" />',
            ]
        ];
        return $customData;
    }

    protected function init()
    {
        $this->data();
        $this->modulPostData();
        $this->data = $this->frontendData->addCustomData($this->data, $this->customData());
    }

    public function run()
    {
        $this->init();
        if ($this->modulPostData->name_url == $this->webhook(1) && empty($this->webhook(2))) {
            $data = $this->data;
            $this->modulConfigurator($data, 'article_list');
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
