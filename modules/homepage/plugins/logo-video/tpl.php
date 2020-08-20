<?php
if ($data['meta_settings']['keys']['logo_firmy']['show'] == 1) {
    $logo_firmy = $this->data['plugin_data']['logo_firmy'];
    ?>
    <img class="center-block" src="<?php echo $logo_firmy; ?>" alt="logo" />
<?php } ?>
<div class="col-xs-12 text-center padding-20">
    <?php echo $data['article']['content']; ?>
    <br/>
    <div style="max-width:500px" class="center-block">
        <div class="resp-container">
            <iframe class="resp-iframe" src="<?php echo WWW_PATH; ?>embed/video/<?php echo $this->data['plugin_data']['video_id']; ?>" allow="encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
</div>