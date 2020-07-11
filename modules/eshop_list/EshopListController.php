<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Categories;
use DntLibrary\App\Data;
use DntLibrary\App\Post;
use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Image;
use DntLibrary\Base\PostMeta;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;
use DntLibrary\Base\Vendor;

class EshopListController extends BaseController
{

    protected $rootCatId = 95;
    protected $pageLimit = 18;
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
    protected $metaData;
    protected $countItems;
    protected $filterUrl;
    protected $finalItems = [];
    protected $pages = [];
    protected $modulUrl;
    protected $modulPostData;
    protected $currencies = ['EUR', 'CZK'];

    public function __construct()
    {
        $this->rest = new Rest();
        $this->dnt = new Dnt();
        $this->frontendData = new Data();
        $this->posts = new Post();
        $this->postMeta = new PostMeta();
        $this->categories = new Categories();
        $this->settings = new Settings();
        $this->image = new Image();
        $this->vendor = new Vendor();
        $this->db = new DB();
    }

    protected function setTitle()
    {
        $catId = is_numeric($this->rest->webhook(3)) ? $this->rest->webhook(3) : 131;
        $categories = $this->categories->getTreePath($catId);
        $i = 0;
        $categoryNames = [];
        $rootTitle = $this->data['meta_settings']['keys']['title']['value'];
        for ($i = count($categories) - 1; $i > 1; $i--) {
            $categoryNames[] = $this->categories->getElement($categories[$i])['name'];
        }
        if (count($categoryNames) > 0) {
            return $this->categories->getElement($catId)['name'] . ' | ' . join(' | ', $categoryNames) . ' | ' . $this->modulPostData->name . ' | ' . $rootTitle;
        }
        return $this->categories->getElement($catId)['name'] . ' | ' . $rootTitle;
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

    protected function paginatedItems()
    {
        (int) $page = ($this->rest->get('page')) ? $this->rest->get('page') : 1;
        $this->currentPage = $page;
        $beginIndex = ($page * $this->pageLimit) - $this->pageLimit;
        $endIndex = $this->pageLimit + $beginIndex - 1;
        $final = [];
        $i = 0;
        foreach ($this->finalItems as $item) {
            if ($beginIndex <= $i && $endIndex >= $i) {
                $final[] = $item;
            }
            $i++;
        }
        $this->countItems = count($final);
        if ($this->countItems > 0) {
            $this->hasItems = true;
        }

        $countPages = ceil(count($this->finalItems) / $this->pageLimit);
        $pages = [];
        for ($i = 1; $i <= $countPages; $i++) {
            $pages[$i] = ($i == $page) ? 'active' : 'default';
        }
        $this->pages = $pages;
        $this->paginatedItems = $final;
        return $final;
    }

    protected function postBaseConfig()
    {
        $final = [];
        $categoryTree = $this->categories->getChildren($this->rootCatId, true);
        $categoryIds = [];
        foreach ($categoryTree as $cat) {
            $categoryIds[] = $cat['id_entity'];
        }

        $data = $this->dnt->orderby($this->posts->postsModel, "name", "ASC");
        foreach ($data as $post) {
            if (in_array($post->post_category_id, $categoryIds)) {
                if ($post->show > 0) {
                    $final[] = $post;
                }
            }
        }
        return $final;
    }

    protected function postFilter()
    {

        $categoryIds = [];
        $final = [];

        if ($this->webhook(2) == 'category' && is_numeric($this->webhook(3))) {
            $categoryTree = $this->categories->getChildren($this->webhook(3), true);
            foreach ($categoryTree as $cat) {
                $categoryIds[] = $cat['id_entity'];
            }
            $filter = "post_category_id IN (" . join(',', $categoryIds) . ") ";
            $this->filterUrl = $this->webhook(2) . '/' . $this->webhook(3);
        } elseif ($this->webhook(2) == 'products' && $this->webhook(3) == 'search') {
            $searhString = str_replace('-', '', $this->dnt->name_url(urldecode($this->rest->get('q'))));
            $filter = "search LIKE '%$searhString%'";
            $this->filterUrl = $this->webhook(2) . '/' . $this->webhook(3) . '/?q=' . $searhString;
        } elseif ($this->webhook(2) == 'products' && $this->webhook(3)) {
            $productsIds = explode('-', $this->webhook(3));
            $filter = "id_entity IN (" . join(',', $productsIds) . ") ";
            $this->filterUrl = $this->webhook(2) . '/' . $this->webhook(3);
        } else {
            $categoryTree = $this->categories->getChildren($this->rootCatId, true);
            foreach ($categoryTree as $cat) {
                $categoryIds[] = $cat['id_entity'];
            }
            $filter = "post_category_id IN (" . join(',', $categoryIds) . ") ";
            $this->filterUrl = '';
        }

        $query = "SELECT * FROM dnt_posts WHERE "
                . "type = 'product' AND "
                . "`show` = '1' AND "
                . "vendor_id = '" . $this->vendor->getId() . "' AND "
                . $filter
                . "ORDER BY name asc";

        if ($this->db->num_rows($query) > 0) {
            $final = $this->db->get_results($query, true);
        }

        /*
         * //$final = [];
        if ($this->webhook(2) == 'category') {
            $this->filterUrl = 'category';
            foreach ($this->postBaseConfig() as $post) {
                $categoryTree = $this->categories->getChildren($this->webhook(3), true);
                $categoryIds = [];
                foreach ($categoryTree as $cat) {
                    $categoryIds[] = $cat['id_entity'];
                }
                if (in_array($post->post_category_id, $categoryIds)) {
                    $final[] = $post;
                }
            }
        } elseif ($this->webhook(2) == 'products' && $this->webhook(3) == 'search') {
            $this->filterUrl = 'products/search';
            foreach ($this->postBaseConfig() as $post) {
                $searhString = str_replace('-', '', $this->dnt->name_url(urldecode($this->rest->get('q'))));
                if ($this->dnt->in_string($searhString, $post->search)) {
                    $final[] = $post;
                }
            }
        } elseif ($this->webhook(2) == 'products') {
            $this->filterUrl = 'products/' . $this->webhook(3);
            foreach ($this->postBaseConfig() as $post) {
                $categoryIds = explode('-', $this->webhook(3));
                if (in_array($post->post_category_id, $categoryIds)) {
                    $final[] = $post;
                }
            }
        } else {
            foreach ($this->postBaseConfig() as $post) {
                $final[] = $post;
            }
        }*/
        $this->finalItems = $final;
    }

    protected function postMeta()
    {
        $ids = [];
        foreach ($this->paginatedItems as $item) {
            $ids[] = $item->id_entity;
        }
        $idsIn = join(',', $ids);
        if ($idsIn) {
            $this->metaData = $this->postMeta->getPostsMeta($idsIn);
        }
    }

    protected function init()
    {
        $this->data();
        $this->modulPostData();
        $this->categories->init();
        $this->posts->init();
        $this->postFilter();
        $this->paginatedItems();
        $this->postMeta();
        $this->data = $this->frontendData->addCustomData($this->data, $this->customData());
    }

    public function run()
    {
        $this->init();
        if (
                $this->modulPostData->name_url == $this->webhook(1) &&
                $this->webhook(2) == 'category' || 'products' &&
                (is_numeric($this->webhook(3)) || $this->webhook(3) == 'search') || is_array(explode('-', $this->webhook(3))) &&
                empty($this->webhook(5))
        ) {
            $data = $this->data;
            $data['items'] = $this->paginatedItems;
            $data['hasItems'] = $this->hasItems;
            $data['currentPage'] = $this->currentPage;
            $data['pages'] = $this->pages;
            $data['modulUrl'] = $this->modulPostData->name_url;
            $data['currentUrl'] = function($page) {
                $url = WWW_PATH . '' . $this->modulPostData->name_url . '/' . $this->filterUrl;
                $hasQueryParams = parse_url($url, PHP_URL_QUERY);
                return ($hasQueryParams) ? $url . '&page=' . $page : $url . '?page=' . $page;
            };
            $data['searchUrl'] = WWW_PATH . '' . $this->modulPostData->name_url . '/products/search';
            $data['countItems'] = $this->countItems;
            $data['postImage'] = function($idEntity) {
                return $this->image->getPostImage($idEntity, 'dnt_posts', IMAGE::MEDIUM);
            };
            $data['postMeta'] = function($postId, $key) {
                return isset($this->metaData['keys'][$postId][$key]) && $this->metaData['keys'][$postId][$key]['show'] == 1 ? $this->metaData['keys'][$postId][$key]['value'] : false;
            };
            $data['detailtUlr'] = function($postId, $nameUrl) {
                return WWW_PATH . '' . $this->modulPostData->name_url . '/product/' . $postId . '/' . $nameUrl . '';
            };
            $data['price'] = function($postId) use ($data) {
                $price = isset($this->metaData['keys'][$postId]['price']) && $this->metaData['keys'][$postId]['price']['show'] == 1 ? $this->metaData['keys'][$postId]['price']['value'] : false;
                foreach ($this->currencies as $currency) {
                    if ($this->dnt->in_string(strtolower($currency), strtolower($price))) {
                        return $price;
                    }
                }

                return $price . ' ' . $data['meta_settings']['keys']['vendor_currency']['value'];
            };
            $data['path'] = WWW_PATH;
            $data['routeCategory'] = is_numeric((int) $this->rest->webhook(3)) ? $this->rest->webhook(3) : $this->rootCatId;
            $data['categoryTree'] = $this->categories->getTreePath($data['routeCategory']);
            $data['categories'] = $this->categories->getChildren($this->rootCatId);
            $data['categoryElement'] = function($id) {
                return $this->categories->getElement($id);
            };

            $this->modulConfigurator($data);
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
