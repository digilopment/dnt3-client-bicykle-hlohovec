<?php $name = $this->data['plugin_data']['plugin_id']; ?>
<div class="slider-wrap">
    <div class="container">
        <div class="col-md-12">
            <div class="dnt-carousel-slider carousel slide" id="<?php echo $name; ?>">
                <div class="carousel-inner">
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
                        <div class="item <?php echo ($i == 0) ? 'active' : false ?>">
                            <div class="col-md-6 col-xs-12">
                                <div class="wrap">
                                    <a href="<?php echo $nameUrl ?>">
                                        <?php if ($perex || $content) { ?>
                                            <div class="text">
                                                <?php echo $perex; ?><br/>
                                                <span class="description"><?php echo $content; ?></span>
                                            </div>
                                        <?php } ?>
                                        <img src="<?php echo $image; ?>" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <a class="left carousel-control" href="#<?php echo $name; ?>" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <a class="right carousel-control" href="#<?php echo $name; ?>" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#<?php echo $name; ?>').carousel({
            interval: 10000
        });

        $('.dnt-carousel-slider.carousel .item').each(function () {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        });
    });
</script>