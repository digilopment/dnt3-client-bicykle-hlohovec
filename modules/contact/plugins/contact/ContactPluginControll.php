<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\App\Post;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Rest;

class ContactPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $item;

    public function __construct($data, $pluginId, $plugin)
    {
        $this->multilanguage = new MultyLanguage;
        $this->frontend = new Frontend();
        $this->posts = new Post();
        $this->dnt = new Dnt();
        $this->rest = new Rest();
        parent::__construct($data, $pluginId, $plugin);
        $this->data = $data;
    }

    protected function getPost()
    {
        $postId = (int) $this->rest->get('productId');
        $this->item = $this->posts->getPost($postId);
    }

    public function init()
    {
        $this->getPost();
    }

    public function run()
    {
        $data = $this->data;
        $data['translate'] = function($translateKey) {
            return $this->multilanguage->translate($this->data, $translateKey, 'translate');
        };
        $data['setting'] = function($key) {
            return $this->frontend->getMetaSetting($this->data, $key);
        };
        $data['googleMaps'] = function($url) {
            return $this->dnt->getMapLocation($url);
        };

        if (isset($this->item->id_entity)) {
            $data['dynamicRequest'] = true;
            $productUrl = WWW_PATH . 'bicykle/product/' . $this->item->id_entity . '/' . $this->item->name_url;
            $data['requestSubject'] = 'Dostupnosť produktu ' . $this->item->name;
            $data['requestContent'] = 'Dobrý deň, chcem sa spýtať na dostupnosť produktu s názvom ' . $this->item->name . ' na tejto adrese: ' . $productUrl . ' Ďakujem za spätnú informáciu.';
        } else {
            $data['dynamicRequest'] = false;
        }

        $this->layout($this->loc, 'tpl', $data);
    }

}
