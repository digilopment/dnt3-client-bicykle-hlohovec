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
                <div class="btn-group show-all-cats">
                    <button title="Zobraziť všetky kategórie v strome" type="button" class="btn btn-default">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
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

                .prod-cat .nav.nav-parent-131 {
                    display: block;
                }

            </style>
            <script>
                $(document).ready(function () {
                    $(".show-all-cats").click(function () {
                        if ($(".show-all-cats").hasClass('isShow')) {
                            $(".eshop .prod-cat .nav").hide();
                            $(".show-all-cats").removeClass('isShow');
                                <?php foreach ($data['getParentElements']($data['routeCategory']) as $parent) { ?>
                                $(".prod-cat .nav.nav-parent-<?php echo $parent; ?>").show();
                                <?php } ?>
                            $(".prod-cat .nav.nav-parent-131").show();
                        } else {
                            $(".eshop .prod-cat .nav").fadeIn();
                            $(".show-all-cats").addClass('isShow');
                        }
                    });
                });
            </script>
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
                        foreach ($this->data['plugin_data']['categoryTree'] as $catId) {
                            if ($i > 0) {
                                ?>
                                <li class="" ><a href="<?php echo $this->data['plugin_data']['path'] . '' . $this->data['plugin_data']['modulUrl'] . '/category/' . $catId; ?>"><?php echo $this->data['plugin_data']['categoryElement']($catId)['name'] ?></a></li>
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
                                <a href="<?php echo $data['detailtUlr']($item->id_entity, $item->name_url) ?>" class="adtocart"> <i class="fa fa-info-circle"></i>
                                </a>
                            </div>
                            <div class="panel-body text-center">
                                <h4><a href="<?php echo $data['detailtUlr']($item->id_entity, $item->name_url) ?>" class="pro-title"> <?php echo $item->name; ?> </a></h4>
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