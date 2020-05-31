<?php

use DntLibrary\Base\Image;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Settings;
use DntLibrary\Base\Url;

$translate['citat_viac'] = MultyLanguage::translate($data, "citat_viac", "translate");
?>
<!-- End header-v8 -->
<?php get_slider($data); ?>
<div class="container margin-bottom-40">
    <?php
    if ($this->posts) {
        ?>
        <div class="col-md-12 homepage">
            <div class="masonry-box homepage-items">
                <div class="row">
                    <?php
                    foreach ($this->posts as $row) {
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
    ?>
    <?php
    if ($data['meta_settings']['keys']['logo_firmy']['show'] == 1) {
        $logo_firmy = Settings::getImage($data['meta_settings']['keys']['logo_firmy']['value']);
        ?>
        <img class="center-block" src="<?php echo $logo_firmy; ?>" alt="logo" />
    <?php } ?>
    <div class="col-xs-12 text-center padding-20">
        <?php echo $data['article']['content']; ?>
        <br/>
        <div style="max-width:500px" class="center-block">
            <?php echo get_video_embed($data, "15021", "transparent"); ?>
        </div>
    </div>

    <?php if ($this->gallery) { ?>
        <div class="padding-20 col-xs-12">
            <div class="blog-grid image_list margin-bottom-30">
                <h2 class="title-v4">&nbsp;</h2>
                <?php
                foreach ($this->gallery as $item) {
                    $img = Image::getFileImage($item, true, Image::SMALL);
                    ?>
                    <div class="col-sm-4" style="margin-top: 10px;">
                        <a data-lightbox="gallery" href="<?php echo Image::getFileImage($item); ?>" target="_blank" class=""><img src="<?php echo $img; ?>" class="img-responsive"></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>