<?php
$requestUrl = function($id, $variant) use ($data) {
    $variant = $data['dnt']->strToHex($variant);
    return WWW_PATH . 'kontakt?productId=' . $id . '&variant=' . $variant . '#form-area';
};
$variants = $data['variants']($data['item']->id_entity);
$variantPriceArr = [];
foreach ($variants as $key => $variant) {
    $variantPrice = $data['variantPrice']($variant['id_entity']);
    $variantPriceArr[$variant['id_entity']] = $variantPrice;
}
?>
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
                    foreach ($this->data['plugin_data']['categoryTreeProduct'] as $catId) {
                        if ($i > 0) {
                            ?>
                            <li class=""><a href="<?php echo $this->data['plugin_data']['path'] . '' . $this->data['plugin_data']['modulUrl'] . '/category/' . $catId; ?>"><?php echo $this->data['plugin_data']['categoryElement']($catId)['name'] ?></a></li>
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
                    <?php $originalImage = $data['postImageOriginal']($data['item']->id_entity); ?>
                    <a href="<?php echo $originalImage ?>" data-lightbox="roadtrip">
                        <img src="<?php echo $data['postImage']($data['item']->id_entity); ?>" class="img-responsive">
                    </a>
                    <a target="_blank" href="<?php echo $originalImage ?>"> <i class="fa fa-external-link"></i> <small>Zobraziť fotku na novej karte</small></a>
                    <?php /*
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
                      </div> */ ?>

                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 right-section">
                <h2 class="name">
                    <?php echo $data['item']->name; ?>
                    <hr/>
                </h2>
                <?php if ($data['postMetaBool']($data['item']->id_entity, 'price')) { ?>
                    <h3 class="price-container">
                        <?php echo $data['price']($data['item']->id_entity); ?>
                        <small>s DPH</small>
                    </h3>
                <?php } ?>
                <div class="product-info">
                    <?php if ($data['postMetaBool']($data['item']->id_entity, 'isInShop')) { ?>
                        <div class="alert alert-info">
                            <strong><i class="fa fa-shopping-cart"></i> Informácia o dostupnosti na predajni:</strong>
                            Produkt máme fyzicky v predajni
                        </div>
                    <?php } ?>
                    <?php if ($data['postMetaBool']($data['item']->id_entity, 'isInStock')) { ?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-shopping-cart "></i> Informácia o dostupnosti na sklade:</strong>
                            Produkt máme fyzicky na sklade (do 96 hodín v predajni)
                        </div>
                    <?php } ?>
                    <div class="links">
                        <?php /* <a href="<?php echo $requestUrl($data['item']->id_entity); ?>" class="btn btn-success"><i class="fa fa-external-link"></i> Spýtať sa na produkt</a> */ ?>
                        <a href="#" data-toggle="modal" data-target="#getQuestion" class="btn btn-success"><i class="fa fa-info-circle"></i>&nbsp;Spýtať sa na produkt</a>
                        <a href="<?php echo $data['categoryUrl'] ?>" class="btn btn-warning"><i class="fa fa-external-link"></i> Pozrieť iné bicykle v tejto kategórii</a>


                        <?php /*
                          <a href="#" data-toggle="modal" data-target="#cartVariants" class="btn btn-primary addToCart"><i class="fa fa-shopping-cart"></i> Pridaď do košíka</a>
                         * */ ?>

                        <!-- The modal -->
                        <div class="modal" id="cartVariants" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="modal-title"><?php echo $data['item']->name; ?></h3>
                                    </div>
                                    <div class="modal-body">
                                        <p><h4>Vyberte si prosím variant</h4></p>
                                        <table class="addToCartTable">
                                            <?php
                                            echo '<tr class="title">'
                                            . '<td class="variant">Variant</td>'
                                            . '<td class="price">Cena</td>'
                                            . '<td class="dostupnost">Dostupnosť</td>'
                                            . '<td class="cart">Košík</td>'
                                            . '</tr>';
                                            foreach ($variants as $key => $variant) {
                                                $inStock = ($variant['isInStock']) ? '<span class="btn btn-primary">Na sklade</span>' : false;
                                                $inShop = ($variant['isInShop']) ? '<span class="btn btn-success">V predajni</span>' : false;
                                                $noAvailable = ($inStock == false && $inShop == false) ? '<a target="_blank" href="' . $requestUrl($variant['id_entity'], $variant['variant']) . '" class="btn btn-warning">Na dotaz</a>' : false;
                                                echo '<tr>'
                                                . '<td class="variant">' . $variant['variant'] . '</td>'
                                                . '<td class="price">' . $variantPriceArr[$variant['id_entity']] . '</td>'
                                                . '<td class="dostupnost">' . $inShop . $inStock . $noAvailable . '</td>'
                                                . '<td class="cart">';
                                                if ($noAvailable == false) {
                                                    echo '<a href="#" class="btn btn-success"><i class="fa fa-shopping-cart"></i> vložiť</a>';
                                                }
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Zavrieť</button>
                                    </div>
                                </div>



                            </div>
                        </div>

                        <!-- The modal -->
                        <div class="modal" id="getQuestion" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="modal-title"><?php echo $data['item']->name; ?></h3>
                                    </div>
                                    <div class="modal-body">
                                        <p><h4>Vyberte si prosím variant</h4></p>
                                        <table class="addToCartTable">
                                            <?php
                                            echo '<tr class="title">'
                                            . '<td class="variant">Variant</td>'
                                            . '<td class="price">Cena</td>'
                                            . '<td class="dostupnost">Dostupnosť</td>'
                                            . '<td class="cart">Spýtať sa</td>'
                                            . '</tr>';
                                            foreach ($variants as $key => $variant) {
                                                $inStock = ($variant['isInStock']) ? '<span class="btn btn-primary">Na sklade</span>' : false;
                                                $inShop = ($variant['isInShop']) ? '<span class="btn btn-success">V predajni</span>' : false;
                                                $noAvailable = ($inStock == false && $inShop == false) ? '<a target="_blank" href="' . $requestUrl($variant['id_entity'], $variant['variant']) . '" class="btn btn-warning">Na dotaz</a>' : false;
                                                echo '<tr>'
                                                . '<td class="variant">' . $variant['variant'] . '</td>'
                                                . '<td class="price">' . $variantPriceArr[$variant['id_entity']] . '</td>'
                                                . '<td class="dostupnost">' . $inShop . $inStock . $noAvailable . '</td>'
                                                . '<td class="cart">';
                                                //if ($noAvailable == false) {
                                                echo '<a target="_blank" href="' . $requestUrl($variant['id_entity'], $variant['variant']) . '" class="btn btn-success"> Spýtať sa na produkt</a>';
                                                //}
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Zavrieť</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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
                                <table class="addToCartTable">
                                    <?php
                                    echo '<tr class="title">'
                                    . '<td class="variant">Variant</td>'
                                    . '<td class="price">Cena</td>'
                                    . '<td class="dostupnost">Dostupnosť</td>'
                                    . '</tr>';
                                    foreach ($variants as $key => $variant) {
                                        $inStock = ($variant['isInStock']) ? '<span class="btn btn-primary">Na sklade</span>' : false;
                                        $inShop = ($variant['isInShop']) ? '<span class="btn btn-success">V predajni</span>' : false;
                                        $noAvailable = ($inStock == false && $inShop == false) ? '<a target="_blank" href="' . $requestUrl($variant['id_entity'], $variant['variant']) . '" class="btn btn-warning">Na dotaz</a>' : false;
                                        echo '<tr>'
                                        . '<td class="variant">' . $variant['variant'] . '</td>'
                                        . '<td class="price">' . $variantPriceArr[$variant['id_entity']] . '</td>'
                                        . '<td class="dostupnost">' . $inShop . $inStock . $noAvailable . '</td>'
                                        . '</tr>';
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

<script>
    $(document).ready(function () {
        $('.product-deatil .description table').removeAttr('style');
        $('.product-deatil .description tr').removeAttr('style');
        $('.product-deatil .description td').removeAttr('style');
        $('.product-deatil .description th').removeAttr('style');
        $('.c-headline.is-specification').removeAttr('style'); //konfiguracia pre kross
    });
</script>