<div class='col-md-9 margin-bottom-60 clearfix'>
    <style>.image_list.blog-grid img {height: 40px;margin: 0px auto;width: initial;}</style>
    <div class='blog-grid image_list margin-bottom-30'>
        <h2 class='title-v4'><?php echo $data['article']['name']; ?></h2>
        <?php
        if ($this->data['plugin_data']['hasPosts']) {
            foreach ($this->data['plugin_data']['items'] as $row) {
                $img = $row['img'];
                $content = $row['content'];
                $perex = $row['perex'];
                $name = $row['name'];
                $url = $row['url'];
                if ($this->data['plugin_data']['isExternal']($url)) {
                    $target = '_blank';
                } else {
                    $target = '_self';
                }
                ?>
                <div class='col-md-4 col-sm-4 col-xs-6' style='margin-top: 50px;'>
                    <a href='<?php echo $url; ?>' target='<?php echo $target; ?>' class=''><img src='<?php echo $img; ?>' class='img-responsive'></a>
                </div>
                <?php
            }
        } else {
            ?>
            <h3 class='title'><?php echo $data['article']['perex']; ?></h3>
            <?php echo $data['article']['content']; ?>
            <?php
        }
        ?>
    </div>
</div>