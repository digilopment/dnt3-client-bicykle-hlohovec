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
            <style>
                .prod-cat .nav{
                    display: none;
                }
                <?php foreach ($data['getParentElements']($data['routeCategory']) as $parent) { ?>
                    .prod-cat .nav.nav-parent-<?php echo $parent; ?> {
                        display: block;
                    }
                <?php } ?>
                .prod-cat .nav.nav-parent-<?php echo $data['routeCategory']; ?> {
                    display: block;
                }
            </style>
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
                    $str = '<li class="' . $type . ' ' . $selected . '">'
                            . '<a class="' . $selected . '" href="' . $data['path'] . '' . $data['modulUrl'] . '/category/' . $element['id_entity'] . '">';

                    if ($data['hasChild']($element['id']) && $element['id'] == $data['routeCategory']) {
                        $str .= '<i class="fa fa-angle-down"></i>';
                    } elseif ($data['hasChild']($element['id'])) {
                        $str .= '<i class="fa fa-angle-right"></i>';
                    } else {
                        $str .= '&nbsp;';
                    }
                    $str .= $element['name'] . ''
                            . '</a><'
                            . '/li>';
                    echo $str;
                }

                function child($data, $parentId)
                {
                    if ($data['hasChild']($parentId)) {
                        echo '<ul class="nav nav-parent-' . $parentId . '">';
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
    </div>

    <div class="col-sm-9 col-md-9 col-lg-9 product">

        <section class="panel tree-path">
            <div class="panel-body no-padding">
                <div class="pull-left">
                    <ul class="pagination pagination-sm pro-page-list">
                        <li class="">
                            <a><i class="fa fa-arrow-right"></i></a>
                        </li>
                        <?php
                        $i = 0;
                        foreach ($this->data['plugin_data']['categoryTreeProduct'] as $catIt) {
                            if ($i > 0) {
                                ?>
                                <li class="" ><a href="<?php echo $this->data['plugin_data']['path'] . '' . $this->data['plugin_data']['modulUrl'] . '/category/' . $catIt; ?>"><?php echo $this->data['plugin_data']['categoryElement']($catIt)['name'] ?></a></li>
                                <?php
                            }
                            $i++;
                        }
                        ?>
                        <li class="active"><a href=""><?php echo $data['item']->name; ?></a></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 left-section">
                    <div class="product-image">
                        <div id="myCarousel-2" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel-2" data-slide-to="0" class="active"></li>
                            </ol>
                            <div class="carousel-inner">
                                <!-- Slide 1 -->
                                <div class="item active">
                                    <img src="<?php echo $data['postImage']($data['item']->id_entity); ?>" alt="" />
                                </div>

                            </div>
                            <a class="left carousel-control" href="#myCarousel-2" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                            <a class="right carousel-control" href="#myCarousel-2" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 right-section">
                    <h2 class="name">
                        <?php echo $data['item']->name; ?>
                        <hr/>
                    </h2>

                    <?php if ($data['postMeta']($data['item']->id_entity, 'price')) { ?>
                        <h3 class="price-container">
                            <?php echo $data['postMeta']($data['item']->id_entity, 'price'); ?>€
                            <small>s DPH</small>
                        </h3>
                    <?php } ?>
                    <div class="links">
                        <a href="<?php echo WWW_PATH; ?>kontakt" class="btn btn-success"><i class="fa fa-external-link"></i> Spýtať sa na produkt</a>
                        <a href="<?php echo $data['categoryUrl'] ?>" class="btn btn-warning"><i class="fa fa-external-link"></i> Pozrieť iné bicykle v tejto kategórii</a>
                    </div>


                </div>
                <div class="col-xs-12">
                    <div class="description description-tabs">
                        <ul id="myTab" class="nav nav-pills no-padding">
                            <li class="active"><a href="#more-information" data-toggle="tab" class="no-margin">Informácie</a></li>
                            <li class=""><a href="#specifications" data-toggle="tab">Špecifikácia</a></li>
                            <li class=""><a href="#variants" data-toggle="tab">Varianty</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="more-information">
                                <br/>
                                <strong> <?php echo $data['item']->name ?></strong>
                                <p>
                                    <?php
                                    $content = explode('<!--params-->', $data['item']->content);
                                    echo $content[0];
                                    ?>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="specifications">
                                <br />

                                <?php
                                if (isset($content[1])) {
                                    echo $content[1];
                                }
                                ?>
                            </div>
                            <div class="tab-pane fade" id="variants">
                                <br />
                                <div class="params">
                                    <table>
                                        <?php
                                        //$variants = json_decode($data['postMeta']($data['item']->id_entity, 'variants'));
                                        //$variants = json_decode($data['postMeta']($data['item']->id_entity, 'variants'), false, 512, JSON_UNESCAPED_UNICODE);
                                        $variants = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data['postMeta']($data['item']->id_entity, 'variants')), true);
                                        //var_dump($variants);
                                        if (is_array($variants)) {
                                            foreach ($variants as $key => $variant) {
                                                if (isset($variant['variant'])) {
                                                    echo '<tr><td>' . $variant['variant'] . '</td></tr>';
                                                }
                                            }
                                        } else {
                                            if ($data['postMeta']($data['item']->id_entity, 'variant')) {
                                                echo '<tr><td>' . $data['postMeta']($data['item']->id_entity, 'variant') . '</td></tr>';
                                            } else {
                                                echo '<tr><td>' . $data['item']->name . '</td></tr>';
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end product -->
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

    .eshop .pagination li a:hover {
        color:#fff
    }
    .eshop .pagination li a {
        margin: 3px;
    }
    .product-list .panel{
        min-height: 350px;
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

    .eshop .links .btn {
        padding: 8px;
        color: #fff;
        font-size: 13px;
        margin: 15px 0px;
        display: block;
    }
    .eshop .links .btn i{
        color: #fff;
    }
    .eshop .btn:hover {
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

    .eshop table {
        font-size: 14px;
        border-collapse: collapse;
        width: 100%;
    }

    .eshop .description{
        margin: 15px 0px;
    }

    .eshop table th, .eshop table td {
        text-align: left;
        padding: 8px;
    }

    .eshop table tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    .eshop table tr td:nth-child(odd){
        font-weight: bold;
        text-align:left;
        width:35%;
    }
    .eshop table tr td:nth-child(even){
        width:65%
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
        .prod-cat .nav{
            display: block;
        }
        .eshop .pagination li a:hover {
            color:#fff
        }
        .eshop .pagination li a {
            margin: 3px;
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

    @media screen and (min-width: 1200px) {
        .eshop .links {
            margin-top: 30px;
            display: block;
        }
        .eshop .links .btn {
            display: inline;
        }
    }


</style>