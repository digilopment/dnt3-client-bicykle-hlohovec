<?php

use DntLibrary\Base\Image;

if ($this->data['plugin_data']['hasItems']) {
    ?>

    <div class="padding-20 col-xs-12">
        <div class="blog-grid image_list margin-bottom-30">
            <h2 class="title-v4">&nbsp;</h2>
            <?php
            foreach ($this->data['plugin_data']['items'] as $item) {
                $img = Image::getFileImage($item, true, Image::SMALL);
                ?>
                <div class="col-sm-4" style="margin-top: 10px;">
                    <a data-lightbox="gallery" href="<?php echo Image::getFileImage($item); ?>" target="_blank" class="">
                        <img src="<?php echo $img; ?>" class="img-responsive" alt="Image gallery">
                    </a>
                </div>
    <?php } ?>
        </div>
    </div>
<?php } ?>