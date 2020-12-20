<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\App\Cart;
use DntLibrary\Base\Rest;

class AddToCartController extends BaseController
{

    protected $postMetaDeta = [];
    protected $postId;
    protected $groupId;

    public function __construct()
    {
		parent::__construct();
        $this->cart = new Cart();
        $this->rest = new Rest();
    }

    protected function init()
    {
        $postId = $this->rest->webhook(3);
        $this->postId = $postId;
        $this->cart->init($postId);
    }

    public function run()
    {
        $this->init();
        var_dump($this->cart->price($this->postId));
        if ($this->cart->checkPost()) {
            $this->cart->addToCart();
            echo 'Produkt vložený do košíka, počet: ' . $this->cart->product();
        } else {
            echo 'ERR';
        }
    }

}
