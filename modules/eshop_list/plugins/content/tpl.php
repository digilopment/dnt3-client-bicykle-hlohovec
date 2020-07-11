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
                            <p class="price"><?php echo $data['price']($item->id_entity); ?></p>
                        </div>
                    </section>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body text-left">
                        <i class="fa fa-exclamation-circle" style="font-size: 50px;color: #da0809;"></i>
                        <h3>Ľutujeme, ale táto sekcia neobsahuje žiadne bicykle.</h3>
                        <h4>Skúste si prosím vybrať inú kategóriu, alebo použiť vyhľadávač.</h4>
                    </div>
                </section>
            </div>
            <?php
        }
        ?>
    </div>
    <section class="panel">
        <div class="panel-body">
            <div class="pull-right">
                <ul class="pagination pagination-sm pro-page-list">
                    <?php foreach ($data['pages'] as $page => $active) { ?>
                        <li class="<?php echo $active; ?>" ><a href="<?php echo $data['currentUrl']($page) ?>"><?php echo $page ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
</div>