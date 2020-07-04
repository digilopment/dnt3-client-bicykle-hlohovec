<div class="col-md-9">
    <div class="blog-grid margin-bottom-30">
        <h2 class="title-v4"><?php echo $data['article']['name']; ?></h2>
        <?php
        if ($this->data['plugin_data']['hasPosts']) {
            foreach ($this->data['plugin_data']['items'] as $row) {
                $img = $row['img'];
                $content = $row['content'];
                $perex = $row['perex'];
                $name = $row['name'];
                $url = $row['url'];
                ?>
                <div class="row">
                    <div class="col-sm-4" style="margin-top: 10px;">
                        <a href="<?php echo $url; ?>" class=""><img src="<?php echo $img; ?>" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-8">
                        <h3 class="title"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></h3>
                        <p class="text-muted"><?php echo $perex ?></p>
                    </div>
                </div>
                <hr>
                <?php
            }
        } else {
            ?>
            <h3 class="title"><?php echo $data['article']['perex']; ?></h3>
            <?php echo $data['article']['content']; ?>
            <?php
        }
        ?>
    </div>
</div>