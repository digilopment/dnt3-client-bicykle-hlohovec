<div class="footer-v8">
    <?php
    $fbPage = $data['meta_settings']['keys']['facebook_page_sw']['value'];
    $fbPost = $data['meta_settings']['keys']['facebook_post_sw']['value'];
    $fbWidht = '400';
    $fbHeight = '600';

    $instaEmbed = $data['meta_settings']['keys']['instagram_sw']['value'];
    $youtubeEmbed = $data['meta_settings']['keys']['youtube_sw']['value'];
    $twitterEmbedCode = $data['meta_settings']['keys']['twitter_sw']['value'];

    $dataSwArr = array(
        $data['meta_settings']['keys']['facebook_page_sw']['show'],
        $data['meta_settings']['keys']['facebook_post_sw']['show'],
        $data['meta_settings']['keys']['instagram_sw']['show'],
        $data['meta_settings']['keys']['youtube_sw']['show'],
        $data['meta_settings']['keys']['twitter_sw']['show'],
    );

    $x = 0;
    foreach ($dataSwArr as $swValue) {
        $x += $swValue;
    }

    if ($x == 1) {
        $colMdSocialWall = 12;
        $wrappWidth = 25;
    } elseif ($x == 2) {
        $colMdSocialWall = 6;
        $wrappWidth = 50;
    } elseif ($x == 3) {
        $colMdSocialWall = 4;
        $wrappWidth = 75;
    } elseif ($x == 4) {
        $colMdSocialWall = 3;
        $wrappWidth = 100;
    } elseif ($x == 5) {
        $colMdSocialWall = "3 width20";
        $wrappWidth = 100;
    }
    ?>
    <?php if ($x > 0) { ?>
        <style>.social-wall .wrapp{margin: 0px auto;width: <?php echo $wrappWidth; ?>%;}</style>
        <section class="social-wall">
            <div class="row wrapp">
                <?php if ($data['meta_settings']['keys']['facebook_page_sw']['show'] == 1) { ?>
                    <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=<?php echo $fbPage; ?>&tabs=timeline&width=<?php echo $fbWidht; ?>&height=<?php echo $fbHeight; ?>&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['facebook_post_sw']['show'] == 1) { ?>
                    <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                        <iframe src="https://www.facebook.com/plugins/post.php?href=<?php echo $fbPost; ?>&tabs=timeline&width=<?php echo $fbWidht; ?>&height=<?php echo $fbHeight; ?>&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['instagram_sw']['show'] == 1) { ?>
                    <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                        <iframe src="<?php echo $instaEmbed; ?>"  style="" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['youtube_sw']['show'] == 1) { ?>
                    <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                        <iframe src="<?php echo $youtubeEmbed; ?>"  style="" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['twitter_sw']['show'] == 1) { ?>
                    <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                        <?php echo $twitterEmbedCode; ?>
                    </div>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-6 column-one md-margin-bottom-50">
                    <h2>Menu</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="mini-menu">
                                <?php
                                foreach ($data['menu_items'] as $item) {
                                    $name_url_1 = $item['name_url'];
                                    $name_1 = $item['name'];
                                    ?>
                                    <li class=" ">
                                        <a  href="<?php echo WWW_PATH . $name_url_1; ?>"><?php echo $name_1; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h2> <?php echo $this->data['plugin_data']['translate']('socialne_siete'); ?></h2>
                    <!-- Social Icons -->
                    <ul class="social-icon-list margin-bottom-20">
                        <?php if ($data['meta_settings']['keys']['facebook_page']['show'] == 1) { ?>
                            <li>
                                <a href="<?php echo $data['meta_settings']['keys']['facebook_page']['value'] ?>" target="_blank">
                                    <i class="rounded-x  fa fa-facebook"></i> 
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($data['meta_settings']['keys']['twitter']['show'] == 1) { ?>
                            <li>
                                <a href="<?php echo $data['meta_settings']['keys']['twitter']['value'] ?>" target="_blank">
                                    <i class="rounded-x  fa fa-twitter"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($data['meta_settings']['keys']['linked_in']['show'] == 1) { ?>
                            <li>
                                <a href="<?php echo $data['meta_settings']['keys']['linked_in']['value'] ?>" target="_blank">
                                    <i class="rounded-x  fa fa-linkedin"></i> 
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($data['meta_settings']['keys']['google_plus']['show'] == 1) { ?>
                            <li>
                                <a href="<?php echo $data['meta_settings']['keys']['google_plus']['value'] ?>" target="_blank">
                                    <i class="rounded-x  fa fa-google-plus"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($data['meta_settings']['keys']['youtube_channel']['show'] == 1) { ?>
                            <li>
                                <a href="<?php echo $data['meta_settings']['keys']['youtube_channel']['value'] ?>" target="_blank">
                                    <i class="rounded-x  fa fa-youtube"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($data['meta_settings']['keys']['instagram']['show'] == 1) { ?>
                            <li>
                                <a href="<?php echo $data['meta_settings']['keys']['instagram']['value'] ?>" target="_blank">
                                    <i class="rounded-x  fa fa-instagram"></i>
                                </a>
                            </li>
                        <?php } ?>	
                    </ul>
                    <!-- End Social Icons -->
                </div>
            </div>
            <!--/end row-->
        </div>
        <!--/end container-->
    </footer>
    <footer class="copyright">
        <div class="container">
            <ul class="list-inline terms-menu">
                <li>
                    <a href="<?php echo WWW_PATH ?>">
                        <?php echo $this->data['plugin_data']['translate']('footer_signature'); ?> <?php echo date("Y"); ?>
                    </a>
                </li>
                <?php if ($data['meta_settings']['keys']['impressum']['show'] == 1) { ?>						
                    <li>
                        <a href="<?php echo $data['meta_settings']['keys']['impressum']['value'] ?>" target="_blank">
                            <?php echo $this->data['plugin_data']['translate']('impressum'); ?>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['data_protection']['show'] == 1) { ?>
                    <li>
                        <a href="<?php echo $data['meta_settings']['keys']['data_protection']['value'] ?>" target="_blank">
                            <?php echo $this->data['plugin_data']['translate']('data_protection'); ?>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a href="<?php echo $this->data['plugin_data']['getModulUrl']('business_conditions') ?>" target="_blank">
                        Obchodné podmienky
                    </a>
                </li>
            </ul>
        </div>
        <!--/end container-->
    </footer>
</div>
<!--=== End Footer v8 ===-->