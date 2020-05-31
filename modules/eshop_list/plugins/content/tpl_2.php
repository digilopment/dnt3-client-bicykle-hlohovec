<div class="margin-bottom-60"></div>
<div class="container eshop margin-bottom-40">
    <div class="col-md-3">
        <section class="panel search">
            <h2 class="title-v4">Vyhľadávanie</h2>
            <form class="search-form" action="<?php echo $data['searchUrl'] ?>">
                <div class="panel-body"><input type="text" placeholder="Vyhľadávanie" name="q" class="form-control" /></div>
            </form>
        </section>
        <section class="panel">
            <h2 class="btn-eshop-menu title-v4">Kategórie 
                <span class="pull-right" ><i class="fa fa-1x fa-bars"></i> </span>
            </h2>
            <div class="panel-body eshop-nav no-padding">
                <?php

                function htmlElement($element, $data)
                {
                    if ($data['hasChild']($element['id'])) {
                        $type = 'parent';
                    } else {
                        $type = 'child';
                    }
                    if ($element['id'] == $data['routeCategory']) {
                        $selected = 'active';
                    } else {
                        $selected = '';
                    }
                    echo '<li class="' . $type . ' ' . $selected . '"><a class="' . $selected . '" href="' . $data['path'] . '' . $data['modulUrl'] . '/category/' . $element['id_entity'] . '"><i class="fa fa-angle-right"></i>' . $element['name'] . '</a></li>';
                }

                function child($data, $parentId)
                {
                    if ($data['hasChild']($parentId)) {
                        echo '<ul class="nav">';
                        foreach ($data['getChildren']($parentId) as $child) {
                            htmlElement($child, $data);
                            child($data, $child['id']);
                        }
                        echo '</ul>';
                    }
                }

                echo '<ul class="nav prod-cat no-padding">';
                foreach ($this->data['plugin_data']['categories'] as $parent) {
                    htmlElement($parent, $this->data['plugin_data']);
                    child($this->data['plugin_data'], $parent['id']);
                }
                echo '</ul>';
                ?>
            </div>
        </section>
        <?php /*
          <section class="panel">
          <header class="panel-heading">Price Range</header>
          <div class="panel-body sliders">
          <div id="slider-range" class="slider"></div>
          <div class="slider-info"><span id="slider-range-amount"></span></div>
          </div>
          </section>
          <section class="panel">
          <h2 class="title-v4">Filter</h2>
          <div class="panel-body ">
          <form role="form product-form">
          <div class="form-group">
          <label>Brand</label>
          <select class="form-control hasCustomSelect" style="-webkit-appearance: menulist-button; width: 231px; position: absolute; opacity: 0; height: 34px; font-size: 12px;">
          <option>Wallmart</option>
          <option>Catseye</option>
          <option>Moonsoon</option>
          <option>Textmart</option>
          </select>
          <span class="customSelect form-control" style="display: inline-block;"><span class="customSelectInner" style="width: 209px; display: inline-block;">Wallmart</span></span>
          </div>
          <div class="form-group">
          <label>Color</label>
          <select class="form-control hasCustomSelect" style="-webkit-appearance: menulist-button; width: 231px; position: absolute; opacity: 0; height: 34px; font-size: 12px;">
          <option>White</option>
          <option>Black</option>
          <option>Red</option>
          <option>Green</option>
          </select>
          <span class="customSelect form-control" style="display: inline-block;"><span class="customSelectInner" style="width: 209px; display: inline-block;">White</span></span>
          </div>
          <div class="form-group">
          <label>Type</label>
          <select class="form-control hasCustomSelect" style="-webkit-appearance: menulist-button; width: 231px; position: absolute; opacity: 0; height: 34px; font-size: 12px;">
          <option>Small</option>
          <option>Medium</option>
          <option>Large</option>
          <option>Extra Large</option>
          </select>
          <span class="customSelect form-control" style="display: inline-block;"><span class="customSelectInner" style="width: 209px; display: inline-block;">Small</span></span>
          </div>
          <button class="btn btn-primary" type="submit">Filter</button>
          </form>
          </div>
          </section>
          <section class="panel">
          <h2 class="title-v4">Náhodný výber</h2>
          <div class="panel-body">
          <div class="best-seller">
          <article class="media">
          <a class="pull-left thumb p-thumb"> <img src="http://thevectorlab.net/flatlab/img/product1.jpg" /> </a>
          <div class="media-body">
          <a href="#" class="p-head">Item One Tittle</a>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          </article>
          <article class="media">
          <a class="pull-left thumb p-thumb"> <img src="http://thevectorlab.net/flatlab/img/product2.png" /> </a>
          <div class="media-body">
          <a href="#" class="p-head">Item Two Tittle</a>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          </article>
          <article class="media">
          <a class="pull-left thumb p-thumb"> <img src="http://thevectorlab.net/flatlab/img/product3.png" /> </a>
          <div class="media-body">
          <a href="#" class="p-head">Item Three Tittle</a>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          </article>
          </div>
          </div>
          </section>
         */ ?>
    </div>
    <div class="col-md-9 product">
        <section class="panel tree-path">
            <div class="panel-body no-padding">
                <div class="pull-left">
                    <ul class="pagination pagination-sm pro-page-list">
                        <li class="">
                            <a><i class="fa fa-arrow-right"></i></a>
                        </li>
                        <?php
                        $i = 0;
                        foreach ($this->data['plugin_data']['categoryTree'] as $catIt) {
                            if ($i > 0) {
                                ?>
                                <li class="" ><a href="<?php echo $this->data['plugin_data']['path'] . '' . $this->data['plugin_data']['modulUrl'] . '/category/' . $catIt; ?>"><?php echo $this->data['plugin_data']['categoryElement']($catIt)['name'] ?></a></li>
                                <?php
                            }
                            $i++;
                        }
                        ?>
                        <li class="active"><a href=""><?php echo ($this->data['plugin_data']['categoryElement']($this->data['plugin_data']['routeCategory'])['name']) ?? 'Bicykle' ?></a></li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="row product-list">
            <?php
            if ($data['hasItems']) {
                foreach ($data['items'] as $item) {
                    ?>
                    <div class="col-md-4">
                        <section class="panel">
                            <div class="pro-img-box">
                                <img src="<?php echo $data['postImage']($item->id_entity); ?>" alt="" />
                                <a href="<?php echo $data['detailtUlr']($item->id_entity, $item->name_url) ?>" class="adtocart"> <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="panel-body text-center">
                                <h4><a href="#" class="pro-title"> <?php echo $item->name; ?> </a></h4>
                                <p class="price"><?php echo $data['postMeta']($item->id_entity, 'price'); ?>€</p>
                            </div>
                        </section>
                    </div>
                    <?php
                }
            } else {
                echo 'No items';
            }
            ?>
        </div>
        <section class="panel">
            <div class="panel-body">
                <div class="pull-right">
                    <ul class="pagination pagination-sm pro-page-list">
                        <?php foreach ($data['pages'] as $page => $active) { ?>
                            <li class="<?php echo $active; ?>" ><a href="<?php $data['currentUrl'] ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

<style type="text/css">
    /*panel*/
    .panel {
        border: none;
        box-shadow: none;
    }
    .panel-heading {
        border-color: #eff2f7;
        font-size: 16px;
        font-weight: 300;
    }
    .panel-title {
        color: #2a3542;
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 0;
        margin-top: 0;
        font-family: "Open Sans", sans-serif;
    }
    .prod-cat li a {
        border-bottom: 1px dashed #d9d9d9;
    }
    .prod-cat li a {
        color: #3b3b3b;
    }
    .prod-cat li ul {
        margin-left: 30px;
    }
    .prod-cat li ul li a {
        border-bottom: none;
    }
    .prod-cat li ul li a:hover,
    .prod-cat li ul li a:focus,
    .prod-cat li ul li.active a,
    .prod-cat li a:hover,
    .prod-cat li a:focus,
    .prod-cat li a.active {
        background: none;
        color: #da0809;
    }
    .pro-lab {
        margin-right: 20px;
        font-weight: normal;
    }
    .pro-sort {
        padding-right: 20px;
        float: left;
    }
    .pro-page-list {
        margin: 5px 0 0 0;
    }
    .product-list img {
        width: 100%;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
    }
    .product-list .pro-img-box {
        position: relative;
    }
    .adtocart {
        background: #fc5959;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        color: #fff;
        display: inline-block;
        text-align: center;
        border: 3px solid #fff;
        left: 45%;
        bottom: -25px;
        position: absolute;
    }
    .adtocart i {
        color: #fff;
        font-size: 25px;
        line-height: 42px;
    }
    .pro-title {
        color: #5a5a5a;
        display: inline-block;
        margin-top: 20px;
        font-size: 16px;
    }
    .product-list .price {
        color: #fc5959;
        font-size: 15px;
    }
    .pro-img-details {
        margin-left: -15px;
    }
    .pro-img-details img {
        width: 100%;
    }
    .pro-d-title {
        font-size: 16px;
        margin-top: 0;
    }
    .product_meta {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 10px 0;
        margin: 15px 0;
    }
    .product_meta span {
        display: block;
        margin-bottom: 10px;
    }
    .product_meta a,
    .pro-price {
        color: #fc5959;
    }
    .pro-price,
    .amount-old {
        font-size: 18px;
        padding: 0 10px;
    }
    .amount-old {
        text-decoration: line-through;
    }
    .quantity {
        width: 120px;
    }
    .pro-img-list {
        margin: 10px 0 0 -15px;
        width: 100%;
        display: inline-block;
    }
    .pro-img-list a {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .pro-d-head {
        font-size: 18px;
        font-weight: 300;
    }

    /** custom **/
    .eshop ul.nav prod-cat{
        padding: 0px;
    }
    .eshop ul.nav{
        padding-left: 15px;
    }
    .eshop .prod-cat li a {
        padding-left: 5px;
    }
    .eshop .nav>li>a>i{
        margin-right: 5px;
    }
    .eshop .nav>li>a{
        font-size: 14px;
        padding: 6px 15px;
    }
    .eshop li.parent{
        font-weight:bold;
        font-size: 16px;
        text-transform: uppercase;
    }

    .eshop .left-columnt ul.navigation-tree li.selected>a,
    .eshop .left-columnt ul.navigation-tree li>a:hover{
        color: #da0809 !important;
    }
    .eshop .panel-heading {
        color: #333;
        font-size:18px;
    }
    .pagination li a:hover,
    .pagination.active li.active {
        color: #fff!important;
        background: #da0809;
        border-color: #ffffff;
        border: 1px solid #da0809;
    }
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        border-color: #da0809;
        background-color: #da0809;
        font-weight: normal;
    }
    .eshop .left-columnt ul.navigation-tree{
        padding-left: 5px;
    }
    .eshop .left-columnt ul{
        padding-left: 20px;
    }
    .eshop .left-columnt ul.navigation-tree li{
        list-style: none;
        font-family: 'Roboto Slab',sans-serif;
        padding-left: 0px;
        font-size: 14px;
        line-height: 25px;
    }
    .eshop .left-columnt ul.navigation-tree li.parent{
        font-weight:bold;
        font-size: 16px;
        text-transform: uppercase;
    }

    .eshop .left-columnt ul.navigation-tree li.selected>a,
    .eshop .left-columnt ul.navigation-tree li>a:hover{
        color: #da0809 !important;
    }

    .eshop .btn-eshop-menu>span{
        display: none;
    }


    .eshop .btn-group-lg>.btn, .eshop .btn-lg {
        font-size: 16px;
    }
    .eshop .btn-success:hover {
        color: #fff!important;
        background-color: #da0809;
        border-color: #da0809;
    }

    .eshop .nav-pills>li.active>a, 
    .eshop .nav-pills>li.active>a:focus, 
    .eshop .nav-pills>li.active>a:hover {
        color: #fff!important;
    }
    .eshop .nav-pills>li.active>a:hover {
        background-color: #da0809;
    }

    .eshop .tree-path ul li a{
        margin: 5px;
        margin-left: 0px;
    }

    @media screen and (max-width: 991px) {
        .eshop .btn-eshop-menu>span{
            display: block;
        }
        .eshop .eshop-nav{
            display: none;
        }
        .eshop .panel.search{
            display: none;
        }

        .eshop .btn-group-lg>.btn, .eshop .btn-lg {
            font-size: 14px;
            display: block;
        }
        .eshop hr{
            margin:5px;
        }
    }

    @media screen and (min-width: 991px) {
        .eshop .product{
            margin-top: 25px;
        }
        .eshop .product .product-image{
            padding:25px 0px;
        }
        .eshop .product .right-section{
            padding:15px 0px;
        }

    }
</style>