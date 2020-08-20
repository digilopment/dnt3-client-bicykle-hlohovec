<div class="blog-ms-v1 content-sm bg-color-darker margin-bottom-60">
    <div class="master-slider ms-skin-default" id="masterslider">
        <?php
        $i = 0;
        foreach ($this->data['plugin_data']['items'] as $item) {
            $nameUrl = false;
            if ($item['is_external_url']) {
                $nameUrl = $item['name_url'];
            }
            $image = $item['image'];
            $perex = $item['perex_not_html'];
            $content = $item['content_not_html'];
            ?>
            <div class="ms-slide blog-slider">
                <img src="<?php echo $image; ?>" data-src="<?php echo $image; ?>" alt="<?php echo $item['name']; ?>"/>
                <span class="blog-slider-badge" <?php if ($nameUrl) { ?> onclick="location.href = '<?php echo $nameUrl ?>';" <?php } ?>>
                    <?php echo $item['name']; ?>
                </span>
                <div class="ms-info"></div>
                <div class="blog-slider-title">
                    <?php if ($nameUrl) { ?>
                        <a target="_blank" href="<?php echo $nameUrl; ?>">
                            <?php if ($perex) { ?>
                                <h2><?php echo $item['perex']; ?></h2>
                            <?php } ?>
                        </a>
                    <?php } else { ?>
                        <?php if ($perex) { ?>
                            <h2><?php echo $item['perex']; ?></h2>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>