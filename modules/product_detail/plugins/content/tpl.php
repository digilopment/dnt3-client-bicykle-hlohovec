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
                            <li class="" ><a href="<?php echo $this->data['plugin_data']['path'] . '' . $this->data['plugin_data']['modulUrl'] . '/category/' . $catId; ?>"><?php echo $this->data['plugin_data']['categoryElement']($catId)['name'] ?></a></li>
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

                <?php if ($data['postMeta']($data['item']->id_entity, 'price')) { ?>
                    <h3 class="price-container">
                        <?php echo $data['price']($data['item']->id_entity); ?>
                        <small>s DPH</small>
                    </h3>
                <?php } ?>
                <div class="links">
                    <a href="<?php echo WWW_PATH; ?>kontakt?productId=<?php echo $data['item']->id_entity; ?>#form-area" class="btn btn-success"><i class="fa fa-external-link"></i> Spýtať sa na produkt</a>
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
                                    $str = $data['postMeta']($data['item']->id_entity, 'variants');
                                    $str = str_replace('")"', ')"', $str);
                                    $str = str_replace('""}]', '"}]', $str);
                                    $variants = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str), true);
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
                                    /* $variants = json_decode($data['postMeta']($data['item']->id_entity, 'variants'));
                                      var_dump($variants);
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
                                      } */
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