<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Cart;
use DntLibrary\App\Categories;
use DntLibrary\App\Data;
use DntLibrary\App\Post;
use DntLibrary\App\PostVariants;
use DntLibrary\Base\Dnt;
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
    protected $currencies = ['EUR', 'CZK'];

    public function __construct()
    {
        $this->rest = new Rest();
        $this->dnt = new Dnt();
        $this->frontendData = new Data();
        $this->posts = new Post();
        $this->postMeta = new PostMeta();
        $this->postVariants = new PostVariants();
        $this->categories = new Categories();
        $this->settings = new Settings();
        $this->image = new Image();
        $this->cart = new Cart();
    }

    protected function setTitle()
    {
        return $this->item->name . ' | ' . $this->modulPostData->name . ' | ' . $this->data['meta_settings']['keys']['title']['value'];
    }

    protected function data()
    {
        $postId = ((int) $this->rest->webhook(3));
        $config = [
            'post_id' => $postId,
            'sitemap_items' => true,
            'menu_items' => true,
            'translates' => true,
            'meta_settings' => true,
        ];
        $this->frontendData->configure($config);
        $this->data = $this->frontendData->get();
    }

    protected function customData()
    {
        $image = $this->data['article']['img'];
        $description = str_replace('"', '', $this->dnt->not_html($this->data['meta_tree']['dnt_posts_content']));
        $title = $this->setTitle();
        $customData = [
            'title' => $title,
            'meta' => [
                '<meta content="' . $title . '" property="og:title" />',
                '<meta content="' . $this->data['title'] . '" property="og:site_name" />',
                '<meta content="' . $image . '" property="og:image" />',
                '<meta name="description" content="' . $description . '" />',
            ]
        ];
        return $customData;
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
        $this->modulPostData();
        $this->categories->init();
        $this->getPost();
        $this->postMeta();
        $this->data = $this->frontendData->addCustomData($this->data, $this->customData());
    }

    protected function variantIds($data)
    {
        $variantsIds = [];
        foreach ($data['variants']($this->item->id_entity) as $item) {
            $variantsIds[] = $item['id_entity'];
        }
        return $variantsIds;
    }

    protected function variantsWithMetaData($idEntity, $addDefaultPost = false)
    {
        $ids = [];
        $metaData = [];

        $items = $this->postVariants->getVariants($idEntity, $addDefaultPost);
        foreach ($items as $item) {
            $ids[] = $item['id_entity'];
        }
        $idsIn = join(',', $ids);
        if ($idsIn) {
            $metaData = $this->postMeta->getPostsMeta($idsIn);
        }

        $final = [];
        foreach ($items as $key => $item) {
            $final[$key] = $item;
            $postId = $item['id_entity'];
            $final[$key]['isInStock'] = isset($metaData['keys'][$postId]['isInStock']) && $metaData['keys'][$postId]['isInStock']['show'] == 1 ? 1 : 0;
            $final[$key]['isInShop'] = isset($metaData['keys'][$postId]['isInShop']) && $metaData['keys'][$postId]['isInShop']['show'] == 1 ? 1 : 0;
            $final[$key]['variant'] = isset($metaData['keys'][$postId]['variant']) && $metaData['keys'][$postId]['variant']['show'] == 1 ? $metaData['keys'][$postId]['variant']['value'] : 0;
            $final[$key]['productId'] = isset($metaData['keys'][$postId]['productId']) && $metaData['keys'][$postId]['productId']['show'] == 1 ? $metaData['keys'][$postId]['productId']['value'] : 0;
        }
        return $final;
    }

    public function run()
    {
        $this->init();
        if (
                $this->modulPostData->name_url == $this->webhook(1) &&
                $this->pathIdentifier == $this->webhook(2) &&
                isset($this->item->id_entity) && is_numeric($this->webhook(3)) &&
                ($this->item->show == 1 || $this->item->show == 2) &&
                $this->item->name_url == $this->webhook(4)
        ) {
            $data = $this->data;

            //ITEM
            $data['item'] = $this->item;
            $data['dnt'] = $this->dnt;
            $data['postMeta'] = function($postId, $key) {
                return isset($this->metaData['keys'][$postId][$key]) && $this->metaData['keys'][$postId][$key]['show'] == 1 ? $this->metaData['keys'][$postId][$key]['value'] : false;
            };
            $data['postMetaBool'] = function($postId, $key) {
                return isset($this->metaData['keys'][$postId][$key]) && $this->metaData['keys'][$postId][$key]['show'] == 1 ? true : false;
            };
            $data['postImage'] = function($idEntity) {
                return $this->image->getPostImage($idEntity, 'dnt_posts', IMAGE::MEDIUM);
            };
            $data['postImageOriginal'] = function($idEntity) {
                return $this->image->getPostImage($idEntity, 'dnt_posts', IMAGE::LARGE);
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

            $data['price'] = function($postId) use ($data) {
                $price = isset($this->metaData['keys'][$postId]['price']) && $this->metaData['keys'][$postId]['price']['show'] == 1 ? $this->metaData['keys'][$postId]['price']['value'] : false;
                foreach ($this->currencies as $currency) {
                    if ($this->dnt->in_string(strtolower($currency), strtolower($price))) {
                        return $price;
                    }
                }
                return $price . ' ' . $data['meta_settings']['keys']['vendor_currency']['value'];
            };

            $data['variantsJson'] = function($idEntity) use($data) {
                return json_decode($this->dnt->hexToStr($data['postMeta']($idEntity, 'variants')), true);
            };

            $data['variants'] = function($idEntity) {
                $variants = $this->variantsWithMetaData($idEntity, true);
                return $variants;
            };

            $prices = $this->cart->price($this->variantIds($data));
            $data['variantPrice'] = function($postId) use ($prices) {
                if (isset($prices[$postId])) {
                    return $prices[$postId];
                }
                return $prices[$this->item->group_id];
            };

            $data['categoryElement'] = function($id) {
                return $this->categories->getElement($id);
            };

            $data['article']['service'] = $this->modul();
            $data['post_id'] = $this->item->id_entity;
            $this->modulConfigurator($data, $this->modul());
        } else {
            $this->dnt->redirect(WWW_PATH . 'bicykle');
        }
    }

}
