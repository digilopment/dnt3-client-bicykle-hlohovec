<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\App\Post;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\PostMeta;
use DntLibrary\Base\Rest;

class BusinessConditionsPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $item;

    public function __construct($data, $pluginId, $plugin)
    {
        $this->posts = new Post();
        $this->postMeta = new PostMeta();
        $this->dnt = new Dnt();
        $this->rest = new Rest();
        parent::__construct($data, $pluginId, $plugin);
        $this->data = $data;
    }

    protected function getPost()
    {
        $postId = (int) $this->rest->get('productId');
        $this->postId = $postId;
        $this->item = $this->posts->getPost($postId);
    }

    public function init()
    {
        $this->getPost();
    }

    public function run()
    {
        $postId = (int) $this->data['post_id'];
        $data = $this->data;
        $postMeta = $this->postMeta->getPostsMeta($postId);
        $data['postMeta'] = function($key) use ($postMeta, $postId) {
            if (isset($postMeta['keys'][$postId][$key]['show']) && $postMeta['keys'][$postId][$key]['show'] == 1) {
                return $postMeta['keys'][$postId][$key]['value'];
            }
            return false;
        };
        $this->layout($this->loc, 'tpl', $data);
    }

}
