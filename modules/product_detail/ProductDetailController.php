<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Categories;
use DntLibrary\App\Post;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\Image;
use DntLibrary\Base\PostMeta;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;

class ProductDetailController extends BaseController
{

    protected $rootCatId = 95;
    protected $pageLimit = 2;
    protected $currentPage = 1;
    protected $rest;
    protected $image;
    protected $dnt;
    protected $settings;
    protected $frontend;
    protected $posts;
    protected $postMeta;
    protected $data;
    protected $hasItems;
    protected $metaData = [];
    protected $countItems;
    protected $filterUrl;
    protected $finalItems = [];
    protected $pages = [];
    protected $modulUrl;
    protected $modulPostData;
    protected $pathIdentifier = 'product';

    public function __construct()
    {
        $this->rest = new Rest();
        $this->dnt = new Dnt();
        $this->frontend = new Frontend();
        $this->posts = new Post();
        $this->postMeta = new PostMeta();
        $this->categories = new Categories();
        $this->settings = new Settings();
        $this->image = new Image();
    }

    protected function setTitle()
    {
        return $this->item->name . ' | ' . $this->modulPostData->name . ' | ' . Settings::get('title');
    }

    protected function data()
    {
        $this->data = $this->frontend->get();
    }

    protected function customData()
    {
        $customData = [
            'title' => $this->setTitle(),
        ];
        return $customData;
    }

    protected function modulPostData()
    {
        $nameUrl = $this->webhook(1);
        foreach ($this->data['menu_items'] as $item) {
            if ($item['name_url'] == $nameUrl) {
                $this->modulPostData = (object) $item;
            }
        }
    }

    protected function webhook($key)
    {
        return isset($this->data['webhook'][$key]) ? $this->data['webhook'][$key] : false;
    }

    protected function postMeta()
    {
        if (isset($this->item->id_entity)) {
            $this->metaData = $this->postMeta->getPostsMeta($this->item->id_entity);
        }
    }

    protected function getPost()
    {
        $postId = (int) $this->webhook(3);
        $this->item = $this->posts->getPost($postId);
    }

    protected function init()
    {
        $this->data();
        $this->categories->init();
        $this->getPost();
        $this->postMeta();
        $this->modulPostData();
        $this->data = $this->frontend->addCustomData($this->data, $this->customData());
    }

    public function run()
    {
        $this->init();
        if (
                $this->modulPostData->name_url == $this->webhook(1) &&
                $this->pathIdentifier == $this->webhook(2) &&
                isset($this->item->id_entity) && is_numeric($this->webhook(3)) &&
                $this->item->name_url == $this->webhook(4)
        ) {
            $data = $this->data;

            //ITEM
            $data['item'] = $this->item;
            $data['postMeta'] = function($postId, $key) {
                return isset($this->metaData['keys'][$postId][$key]) && $this->metaData['keys'][$postId][$key]['show'] == 1 ? $this->metaData['keys'][$postId][$key]['value'] : false;
            };
            $data['postImage'] = function($idEntity) {
                return $this->image->getPostImage($idEntity, 'dnt_posts', IMAGE::MEDIUM);
            };
            $data['hasItem'] = isset($this->item->id_entity) ? true : false;

            //CATEGORIES
            $data['searchUrl'] = WWW_PATH . $this->modulPostData->name_url . '/products/search';
            $data['modulUrl'] = $this->modulPostData->name_url;
            $data['path'] = WWW_PATH;
            $data['routeCategory'] = $this->item->post_category_id;
            $data['categoryTree'] = $this->categories->getTreePath($data['routeCategory']);
            $data['categoryTreeProduct'] = $this->categories->getTreePath($this->item->post_category_id);
            $data['categories'] = $this->categories->getChildren($this->rootCatId);

            $data['categoryUrl'] = WWW_PATH . '' . $this->modulPostData->name_url . '/category/' . $this->item->post_category_id;

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

            $data['article']['service'] = $this->modul();
            $data['post_id'] = $this->item->id_entity;

            $this->modulConfigurator($data, $this->modul());
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
