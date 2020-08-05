<?php

namespace DntView\Layout\Modul;

use App\AggrBuilder;
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
        $this->aggrBuilder = new AggrBuilder();
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

    protected function postFilter()
    {

        $categoryIds = [$this->rootCatId];
        $final = [];

        if ($this->webhook(2) == 'category' && (is_numeric($this->webhook(3)) || $this->dnt->in_string('-', $this->webhook(3)))) {

            if (is_numeric($this->webhook(3))) {
                $categoryTree = $this->categories->getChildren($this->webhook(3), true);
                foreach ($categoryTree as $cat) {
                    $categoryIds[] = $cat['id_entity'];
                }
            } else {
                foreach (explode('-', $this->webhook(3)) as $catId) {
                    if (is_numeric($catId)) {
                        foreach ($this->categories->getChildren($catId, true) as $cat) {
                            $categoryIds[] = $cat['id_entity'];
                        }
                    }
                }
            }
            $filter = "post_category_id IN (" . join(',', $categoryIds) . ") ";
            $this->filterUrl = $this->webhook(2) . '/' . $this->webhook(3);
        } elseif ($this->webhook(2) == 'products' && $this->webhook(3) == 'search') {
            $searchStr = false;
            if ($this->aggrDecode['q']) {
                $searchStr = $this->aggrDecode['q'];
            } elseif ($this->rest->get('q')) {
                $searchStr = $this->rest->get('q');
            }
            $searhString = str_replace('-', '', $this->dnt->name_url(urldecode($searchStr)));
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
                . "ORDER BY id ASC ";

        $this->finalItems = $this->db->get_results($query);
    }

    protected function postsWithMetaData()
    {
        $ids = [];
        $metaData = [];
        foreach ($this->finalItems as $item) {
            $ids[] = $item['id_entity'];
        }
        $idsIn = join(',', $ids);
        if ($idsIn) {
            $metaData = $this->postMeta->getPostsMeta($idsIn);
        }

        $final = [];
        foreach ($this->finalItems as $key => $item) {
            $final[$key] = $item;
            $postId = $item['id_entity'];
            $final[$key]['price'] = isset($metaData['keys'][$postId]['price']) && $metaData['keys'][$postId]['price']['show'] == 1 ? $metaData['keys'][$postId]['price']['value'] : false;
        }
        $this->finalItems = $final;
    }

    protected function aplyFilter()
    {
        $final = [];
        if (isset(explode('-', $this->aggrDecode['range'])[1]) && explode('-', $this->aggrDecode['range'])[1] > 0) {
            $this->priceRange = [explode('-', $this->aggrDecode['range'])[0], explode('-', $this->aggrDecode['range'])[1]];
            foreach ($this->finalItems as $key => $item) {
                if ($item['price'] >= $this->priceRange[0] && $item['price'] <= $this->priceRange[1]) {
                    $final[$key] = $item;
                }
            }
            $this->finalItems = $final;
        }

        if ($this->aggrDecode['type']) {
            $ids = [];
            $final = [];
            $finalSubCats = [];
            foreach ($this->categories->getChildren($this->webhook(3), true) as $cat) {
                foreach (explode('-', $this->aggrDecode['type']) as $partial) {
                    if ($this->dnt->in_string($partial, $cat['name_url'])) {
                        $ids[] = $cat['id_entity'];
                    }
                }
            }
            foreach ($ids as $id) {
                foreach ($this->categories->getChildren($id, true) as $lastChild) {
                    $finalSubCats[$lastChild['id_entity']] = $lastChild['id_entity'];
                }
            }
            foreach ($this->finalItems as $key => $item) {
                if (in_array($item['post_category_id'], $finalSubCats)) {
                    $final[$key] = $item;
                }
            }
            $this->finalItems = $final;
        }
    }

    protected function order()
    {
        $this->finalItems = $this->dnt->orderby($this->finalItems, $this->aggrDecode['sort'], $this->aggrDecode['sortType']);
    }

    protected function paginatedItems()
    {
        $posts = $this->finalItems;
        (int) $page = $this->aggrDecode['page'];
        $this->currentPage = $page;
        $beginIndex = ($page * $this->pageLimit) - $this->pageLimit;
        $endIndex = $this->pageLimit + $beginIndex - 1;
        $final = [];
        $i = 0;
        foreach ($posts as $item) {
            if ($beginIndex <= $i && $endIndex >= $i) {
                $final[] = $item;
            }
            $i++;
        }
        $this->countItems = count($final);
        if ($this->countItems > 0) {
            $this->hasItems = true;
        }

        $countPages = ceil(count($posts) / $this->pageLimit);
        $pages = [];
        for ($i = 1; $i <= $countPages; $i++) {
            $pages[$i] = ($i == $page) ? 'active' : 'default';
        }
        $this->pages = $pages;
        $this->paginatedItems = $final;
    }

    protected function setAggrParams($customParams = [])
    {
        $q = false;
        if ($this->rest->get('q')) {
            $q = $this->rest->get('q');
        } elseif (isset($this->aggrBuilder->decode()->q)) {
            $q = $this->aggrBuilder->decode()->q;
        }
        $decoded = [
            'sort' => $this->aggrBuilder->decode()->sort ?? 'price',
            'sortType' => $this->aggrBuilder->decode()->sortType ?? 'ASC',
            'range' => $this->aggrBuilder->decode()->range ?? '0',
            'type' => $this->aggrBuilder->decode()->type ?? false,
            'page' => $this->aggrBuilder->decode()->page ?? 1,
            'q' => $q,
        ];
        $finalDecoded = array_merge($decoded, $customParams);
        $this->aggrEncoded = $this->aggrBuilder->encode($finalDecoded);
        $this->aggrDecode = $decoded;
    }

    protected function posts()
    {
        $this->posts->init();
        $this->postFilter();
        $this->postsWithMetaData();
        $this->aplyFilter();
        $this->order();
        $this->paginatedItems();
    }

    protected function init()
    {
        $this->setAggrParams();
        $this->data();
        $this->modulPostData();
        $this->categories->init();
        $this->posts();
        $this->data = $this->frontendData->addCustomData($this->data, $this->customData());
    }

    protected function types()
    {
        return array(
            "0" => "všetky",
            "fully" => "MTB Fully",
            "hardtaily-horske" => "MTB Hardtaily",
            "crossove-cross-trekkingove" => "Krosové a trekingové bicykle",
            "cestne" => "Cestné bicykle",
            "gravel" => "Gravel",
            "city-mestske" => "Mestské bicykle",
            "skladacie" => "Skladacie",
            "damske" => "Dámske bicykle",
            "detske" => "Detské bicykle",
            "elektro" => "Elektro bicykle"
        );
    }

    protected function priceRange()
    {
        $final = [];
        for ($i = 100; $i <= 700; $i += 50) {
            $final[$i] = 'do ' . $i . ' €';
        }
        for ($i = 700; $i <= 2000; $i += 150) {
            $final[$i] = 'do ' . $i . ' €';
        }
        for ($i = 2000; $i <= 7000; $i += 500) {
            $final[$i] = 'do ' . $i . ' €';
        }
        return $final;
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
                $this->setAggrParams(['page' => $page]);
                $url = explode('?', WWW_FULL_PATH);
                return $url[0] . '?aggrBuilder=' . $this->aggrEncoded;
            };
            $data['searchUrl'] = WWW_PATH . '' . $this->modulPostData->name_url . '/products/search';
            $data['countItems'] = $this->countItems;
            $data['postImage'] = function($idEntity) {
                return $this->image->getPostImage($idEntity, 'dnt_posts', IMAGE::MEDIUM);
            };
            $data['detailtUlr'] = function($postId, $nameUrl) {
                return WWW_PATH . '' . $this->modulPostData->name_url . '/product/' . $postId . '/' . $nameUrl . '';
            };
            $data['path'] = WWW_PATH;
            $data['routeCategory'] = is_numeric((int) $this->rest->webhook(3)) ? $this->rest->webhook(3) : $this->rootCatId;
            $data['categoryTree'] = $this->categories->getTreePath($data['routeCategory']);
            $data['categories'] = $this->categories->getChildren($this->rootCatId);
            $data['categoryElement'] = function($id) {
                return $this->categories->getElement($id);
            };
            $data['aggrDecode'] = $this->aggrDecode;
            $data['types'] = $this->types();
            $data['priceRange'] = $this->priceRange();
            $this->modulConfigurator($data);
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
