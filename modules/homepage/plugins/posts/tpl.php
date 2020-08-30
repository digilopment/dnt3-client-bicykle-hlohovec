<?php
$translate['citat_viac'] = $this->data['plugin_data']['translate']('citat_viac');
if ($this->data['plugin_data']['hasItems']) {
    ?>
    <div class="col-md-12 homepage">
        <div class="masonry-box homepage-items">
            <div class="row">
                <?php
                foreach ($this->data['plugin_data']['items'] as $row) {
                    $url = $this->data['plugin_data']['urlFormat']($row['name_url']);
                    ?>
                    <div class="blog-grid masonry-box-in col-3">
                        <h3><a href="<?php echo $url ?>"><?php echo $row['name']; ?></a></h3>
                        <hr>
                        <p><?php echo $row['perex']; ?></p>
                        <a class="r-more" href="<?php echo $url ?>"><?php echo $translate['citat_viac']; ?></a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>