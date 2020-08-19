<div class="col-sm-3"></div>
<div class="col-sm-9 product-list reletaed">
    <div class="section-title btn btn-primary">Podobné produkty</div>
    <?php if (count($this->data['plugin_data']['items']) > 0) { ?>
        <div class="slide-content">
            <div class="related-products">
                <ul>
                    <?php foreach ($this->data['plugin_data']['items'] as $item) { ?>
                        <li>
                            <a spark_ve_preview="none" href="<?php echo $this->data['plugin_data']['detailtUrl']($item['id_entity'], $item['name_url']); ?>" title="<?php echo $item['name']; ?>">
                                <img alt="<?php echo $item['name']; ?>" src="<?php echo $this->data['plugin_data']['postImage']($item['id_entity']); ?>" class="img-responsive">
                                <div class="thumb_info">
                                    <div class="name">
                                        <?php echo $item['name']; ?>

                                        <span class="thumb_slider_icon"></span>
                                    </div>	
                                    <div class="price"><?php echo $item['price']; ?> €</div>
                                </div>
                            </a>		
                        </li>		
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>