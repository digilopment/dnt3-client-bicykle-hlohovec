<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;

class ArticleViewController extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        $this->frontend = new Frontend();
        $this->rest = new Rest();
        $this->dnt = new Dnt();
    }

    protected function setTitle()
    {
        return $this->data['article']['name'] . ' | ' . $this->modulPostData->name . ' | ' . $this->settings->get('title');
    }

    protected function data()
    {
        $this->data = $this->frontend->get(false, $this->rest->webhook(3));
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
        $this->data = $this->frontend->addCustomData($this->data, $this->customData());
    }

    public function run()
    {
        $this->init();
        $nameUrlArr = explode('/', $this->data['article']['name_url']);
        $nameUrl = end($nameUrlArr);
        if (
                $this->modulPostData->name_url == $this->webhook(1) &&
                is_numeric($this->webhook(3)) &&
                $this->webhook(4) == $nameUrl
        ) {
            $data = $this->data;
            $this->modulConfigurator($data, 'article_view');
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}