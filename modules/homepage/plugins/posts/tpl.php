<?php

use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Url;

$translate['citat_viac'] = MultyLanguage::translate($data, "citat_viac", "translate");
if ($this->data['plugin_data']['hasItems']) {
    ?>
    <div class="col-md-12 homepage">
        <div class="masonry-box homepage-items">
            <div class="row">
                <?php
                foreach ($this->data['plugin_data']['items'] as $row) {
                    ?>
                    <div class="blog-grid masonry-box-in col-3">
                        <h3><a href="<?php echo Url::getPostUrl($row['name_url']) ?>">
        <?php echo $row['name']; ?></a>
                        </h3>
                        <hr>
                        <p><?php echo $row['perex']; ?></p>
                        <a class="r-more" href="<?php echo Url::getPostUrl($row['name_url']) ?>"><?php echo $translate['citat_viac']; ?></a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <!-- End Blog Grid -->
    </div>
    <?php
}