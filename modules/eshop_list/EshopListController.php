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

        if (isset($this->aggrBuilder->decode()->sort) && isset($this->aggrBuilder->decode()->sortType)) {
            $this->orderByMetaKey = $this->aggrBuilder->decode()->sort;
            $this->orderByType = $this->aggrBuilder->decode()->sortType;
        } else {
            $this->orderByMetaKey = 'price';
            $this->orderByType = 'ASC';
        }

        $query = "SELECT 
                    `dnt_posts`.id               AS id, 
                    `dnt_posts`.id_entity        AS id_entity, 
                    `dnt_posts`.post_category_id AS post_category_id, 
                    `dnt_posts`.sub_cat_id       AS sub_cat_id, 
                    `dnt_posts`.cat_id           AS cat_id, 
                    `dnt_posts`.type             AS type, 
                    `dnt_posts`.name             AS name, 
                    `dnt_posts`.name_url         AS name_url, 
                    `dnt_posts`.position         AS position, 
                    `dnt_posts`.priority         AS priority, 
                    `dnt_posts`.service          AS service, 
                    `dnt_posts`.service_id       AS service_id, 
                    `dnt_posts`.img              AS img, 
                    `dnt_posts`.datetime_creat   AS datetime_creat, 
                    `dnt_posts`.datetime_update  AS datetime_update, 
                    `dnt_posts`.datetime_publish AS datetime_publish, 
                    `dnt_posts`.microtime        AS microtime, 
                    `dnt_posts`.perex            AS perex, 
                    `dnt_posts`.content          AS content, 
                    `dnt_posts`.tags             AS tags, 
                    `dnt_posts`.embed            AS embed, 
                    `dnt_posts`.custom           AS custom, 
                    `dnt_posts`.prilohy          AS prilohy, 
                    `dnt_posts`.order            AS `order`, 
                    `dnt_posts`.show             AS `show`, 
                    `dnt_posts`.search           AS search, 
                    `dnt_posts`.protected        AS protected, 
                    `dnt_posts`.vendor_id        AS vendor_id, 
                    `dnt_posts`.parent_id        AS parent_id,
                    CAST(`dnt_posts_meta`.`value` AS DECIMAL(10,2)) " . $this->orderByMetaKey . "
                FROM 
                    dnt_posts 
                LEFT JOIN 
                    dnt_posts_meta 
                ON 
                    dnt_posts.id_entity = dnt_posts_meta.post_id 
                WHERE  
                    dnt_posts.vendor_id = '" . $this->vendor->getId() . "' AND 
                    dnt_posts.`type` = 'product' AND 
                    dnt_posts.`show` = '1' AND 
                    dnt_posts_meta.`key` = '" . $this->orderByMetaKey . "' AND  
                    " . $filter . " 
                GROUP  BY 
                    dnt_posts.id_entity 
                ORDER  BY 
                    " . $this->orderByMetaKey . " " . $this->orderByType;

        if ($this->orderByMetaKey == 'name') {
            $query = "SELECT * FROM dnt_posts WHERE "
                    . "type = 'product' AND "
                    . "`show` = '1' AND "
                    . "vendor_id = '" . $this->vendor->getId() . "' AND "
                    . $filter
                    . "ORDER BY " . $this->orderByMetaKey . " " . $this->orderByType;
        }

        if ($this->db->num_rows($query) > 0) {
            $final = $this->db->get_results($query, true);
        }

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

    protected function aggrIndex()
    {
        $priceAsc = [
            'sort' => 'price',
            'sortType' => 'asc'
        ];
        $priceDesc = [
            'sort' => 'price',
            'sortType' => 'desc'
        ];

        $this->priceAsc = $this->aggrBuilder->encode($priceAsc);
        $this->priceDesc = $this->aggrBuilder->encode($priceDesc);
    }

    protected function init()
    {
        $this->aggrIndex();
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
            $data['orderBy'] = $this->orderByMetaKey;
            $data['orderByType'] = $this->orderByType;
            $data['modulUrl'] = $this->modulPostData->name_url;
            $data['currentUrl'] = function($page) {
                $url = WWW_FULL_PATH;
                if ($this->dnt->in_string('page=', WWW_FULL_PATH)) {
                    return str_replace('page=' . $this->rest->get('page'), 'page=' . $page, $url);
                } else {
                    $hasQueryParams = parse_url($url, PHP_URL_QUERY);
                    return ($hasQueryParams) ? $url . '&page=' . $page : $url . '?page=' . $page;
                }
                /* $url = WWW_PATH . '' . $this->modulPostData->name_url . '/' . $this->filterUrl; 
                  $url .= ($this->rest->get('aggrBuilder')) ? '?aggrBuilder=' . $this->rest->get('aggrBuilder') : false;

                  $hasQueryParams = parse_url($url, PHP_URL_QUERY);
                  return ($hasQueryParams) ? $url . '&page=' . $page : $url . '?page=' . $page;
                 * */
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
            $data['sortByPriceAsc'] = $this->aggrBuilder->build($this->priceAsc);
            $data['sortByPriceDesc'] = $this->aggrBuilder->build($this->priceDesc);
            $this->modulConfigurator($data);
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
