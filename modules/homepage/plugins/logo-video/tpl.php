<?php

use DntLibrary\Base\Settings;

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