<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Categories;
use DntLibrary\App\Plugin;
use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Image;
use DntLibrary\Base\PostMeta;
use DntLibrary\Base\Vendor;

class RelatedProductsPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;
    protected $db;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->db = new DB();
        $this->categories = new Categories();
        $this->vendor = new Vendor();
        $this->postMeta = new PostMeta();
        $this->image = new Image();
        $this->dnt = new Dnt();
    }

    protected function postModel()
    {
        $categoryTree = $this->categories->getChildren((int) $this->data['routeCategory'], true);
        foreach ($categoryTree as $cat) {
            $categoryIds[] = $cat['id_entity'];
        }

        $filter = "post_category_id IN (" . join(',', $categoryIds) . ") ";
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

    protected function postFilter()
    {
        $productprice = (int) ($this->data['postMeta']($this->data['post_id'], 'price'));
        $productLimitLess = 3;
        $productLimitBigg = 3;
        $tempFinalBig = [];
        $tempFinalLess = [];
        $this->items = $this->dnt->orderby($this->finalItems, 'price', 'ASC');
        foreach ($this->items as $key => $item) {
            if ((int) $item['price'] <= $productprice && $item['id_entity'] != $this->data['post_id']) {
                $tempFinalLess[$key] = $item;
            }
            if ((int) $item['price'] >= $productprice && $item['id_entity'] != $this->data['post_id']) {
                $tempFinalBig[$key] = $item;
            }
        }

        //LESS
        $finalLess = [];
        $i = 1;
        $this->tempFinalLess = $this->dnt->orderby($tempFinalLess, 'price', 'DESC');
        foreach ($this->tempFinalLess as $key => $item) {
            if ($i <= $productLimitLess) {
                $finalLess[$key] = $item;
                $i++;
            }
        }

        //BIG
        $finalBig = [];
        $j = 1;
        $this->tempFinalBig = $this->dnt->orderby($tempFinalBig, 'price', 'ASC');
        foreach ($this->tempFinalBig as $key => $item) {
            if ($j <= $productLimitBigg) {
                $finalBig[$key] = $item;
                $j++;
            }
        }
        
        $this->finalItems = array_merge($finalLess, $finalBig);
        $this->finalItems = $this->dnt->orderby($this->finalItems, 'price', 'ASC');
    }

    public function init()
    {
        $this->categories->init();
        $this->postModel();
        $this->postsWithMetaData();
        $this->postFilter();
    }

    public function run()
    {
        $data = $this->data;
        $data['items'] = $this->finalItems;
        $data['postImage'] = function($idEntity) {
            return $this->image->getPostImage($idEntity, 'dnt_posts', IMAGE::MEDIUM);
        };
        $data['detailtUrl'] = function($postId, $nameUrl) use($data) {
            return WWW_PATH . '' . $data['webhook'][1] . '/product/' . $postId . '/' . $nameUrl . '';
        };
        $this->layout($this->loc, 'tpl', $data);
    }

}
