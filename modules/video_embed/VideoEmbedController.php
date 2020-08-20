<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Data;
use DntLibrary\App\Post;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Image;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;

class VideoEmbedController extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        $this->frontendData = new Data();
        $this->rest = new Rest();
        $this->dnt = new Dnt();
        $this->image = new Image();
        $this->post = new Post();
    }

    protected function postObject()
    {
        $postId = (int) $this->rest->webhook(3);
        $this->postObject = $this->post->getPost($postId);
    }

    protected function setTitle()
    {
        return $this->modulPostData->name . ' | ' . $this->settings->get('title');
    }

    protected function data()
    {
        if (isset($this->postObject->id_entity)) {
            $config = [
                'post_object' => $this->postObject,
                'sitemap_items' => false,
                'menu_items' => false,
                'translates' => false,
                'meta_settings' => true,
            ];
            $this->frontendData->configure($config);
            $this->data = $this->frontendData->get();
        }
    }

    protected function webhook($key)
    {
        return isset($this->data['webhook'][$key]) ? $this->data['webhook'][$key] : false;
    }

    protected function modulPostData()
    {
        $this->modulPostData = (object) $this->data['article'];
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
        $this->postObject();
        if (isset($this->postObject->id_entity)) {
            $this->data();
            $this->modulPostData();
            $this->data = $this->frontendData->addCustomData($this->data, $this->customData());
        }
    }

    public function run()
    {
        $this->init();
        if (isset($this->postObject->id_entity) && is_numeric($this->webhook(3)) && $this->postObject->show != 0) {
            $data = $this->data;
            $data['favicon'] = $this->settings->getImage($data['meta_settings']['keys']['favicon']['value']);
            $data['video_id'] = $this->data['post_id'];
            $data['image'] = $data['article']['img'];
            $data['video_file'] = $this->image->getFileImage($data['article']['service_id']);
            $this->modulConfigurator($data, 'video_embed');
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
