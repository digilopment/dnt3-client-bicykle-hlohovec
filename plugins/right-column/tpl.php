<div class="col-md-3">

    <?php if (count($this->data['plugin_data']['items']) > 0) { ?>
        <div class="clearfix margin-bottom-50 dalsie-info">
            <h2 class="title-v4 "><?php echo $this->data['plugin_data']['translate']('partneri'); ?></h2>
            <div class="blog-thumb-v3">
                <?php foreach ($this->data['plugin_data']['items'] as $post) { ?>
                    <?php if ($post['is_external_url']) { ?>
                        <a target="_blank" href="<?php echo $post['name_url']; ?>">
                            <img  src="<?php echo $post['image']; ?>" alt="<?php echo $post['name'] ?>" class="partners-logos" />
                        </a>
                    <?php } else { ?>
                        <img  src="<?php echo $post['image']; ?>" alt="<?php echo $post['name'] ?>" class="partners-logos" />
                    <?php } ?>
                <?php } ?>

            </div>
            <hr class="hr-xs">
        </div>
    <?php } ?>

    <div class="margin-bottom-50 dalsie-info">
        <h2 class="title-v4 ">
            <?php echo $this->data['plugin_data']['translate']('otvaracie_hodiny'); ?>
        </h2>
        <div class="blog-thumb-v3">
            <ul class="logos">
                <?php
                $logo_firmy = $this->data['plugin_data']['logo_firmy'];
                $logo_firmy_2 = $this->data['plugin_data']['logo_firmy_2'];
                $logo_firmy_3 = $this->data['plugin_data']['logo_firmy_3'];
                $logo_url = $data['meta_settings']['keys']['logo_url']['value'];
                $logo_url_2 = $data['meta_settings']['keys']['logo_url_2']['value'];
                $logo_url_3 = $data['meta_settings']['keys']['logo_url_3']['value'];
                ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy']['show'] == 1) { ?>
                    <li>
                        <a target="_blank" href="<?php echo $logo_url; ?>">
                            <img class="img-responsive" src="<?php echo $logo_firmy; ?>" alt="logo" style="margin-bottom: 20px;"/>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy_2']['show'] == 1) { ?>
                    <li>
                        <a target="_blank" href="<?php echo $logo_url_2; ?>">
                            <img class="img-responsive" src="<?php echo $logo_firmy_2; ?>" alt="logo" />
                        </a>
                    </li>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy_3']['show'] == 1) { ?>
                    <li >
                        <a target="_blank" href="<?php echo $logo_url_3; ?>">
                            <img class="img-responsive" src="<?php echo $logo_firmy_3; ?>" alt="logo" />
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <ul>
                <li >
                    <?php echo $this->data['plugin_data']['translate']('od_pondelok'); ?>
                </li>
                <li >
                    <?php echo $this->data['plugin_data']['translate']('od_utorok'); ?>
                </li>
                <li >
                    <?php echo $this->data['plugin_data']['translate']('od_streda'); ?>
                </li>
                <li >
                    <?php echo $this->data['plugin_data']['translate']('od_stvrtok'); ?>
                </li>
                <li >
                    <?php echo $this->data['plugin_data']['translate']('od_piatok'); ?>
                </li>
                <li >
                    <?php echo $this->data['plugin_data']['translate']('od_sobota'); ?>
                </li>
                <li >
                    <?php echo $this->data['plugin_data']['translate']('od_nedela'); ?>
                </li>

            </ul>
        </div>
    </div>
    <div class="margin-bottom-50 dalsie-info">
        <h2 class="title-v4 ">
            <?php echo $this->data['plugin_data']['translate']('kontakt'); ?>
        </h2>
        <div class="blog-thumb-v3">
            <ul class="col-right logos">
                <li>
                    <a href="<?php echo $this->data['plugin_data']['getModulUrl']('contact'); ?>">
                        <span class="btn-u">
                            <?php echo $this->data['plugin_data']['translate']('kontakt'); ?>
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="col-right logos">
                <li>
                    <a href="<?php echo $this->data['plugin_data']['getModulUrl']('business_conditions'); ?>">
                        <span class="btn-u">Obchodné podmienky</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Blog Thumb v3 -->
    <!-- Social Shares -->
    <div class="margin-bottom-50">
        <h2 class="title-v4">
            <?php echo $this->data['plugin_data']['translate']('socialne_siete'); ?>
        </h2>
        <ul class="blog-social-shares">
            <?php if ($data['meta_settings']['keys']['facebook_page']['show'] == 1) { ?>
                <li>
                    <a href="<?php echo $data['meta_settings']['keys']['facebook_page']['value'] ?>" target="_blank">
                        <i class="rounded-x fb fa fa-facebook"></i> Facebook
                    </a>
                </li>
            <?php } ?>
            <?php if ($data['meta_settings']['keys']['twitter']['show'] == 1) { ?>
                <li>
                    <a href="<?php echo $data['meta_settings']['keys']['twitter']['value'] ?>" target="_blank">
                        <i class="rounded-x tw fa fa-twitter"></i>Twitter
                    </a>
                </li>
            <?php } ?>
            <?php if ($data['meta_settings']['keys']['linked_in']['show'] == 1) { ?>
                <li>
                    <a href="<?php echo $data['meta_settings']['keys']['linked_in']['value'] ?>" target="_blank">
                        <i class="rounded-x li fa fa-linkedin"></i> LinkedIn
                    </a>
                </li>
            <?php } ?>
            <?php if ($data['meta_settings']['keys']['google_plus']['show'] == 1) { ?>
                <li>
                    <a href="<?php echo $data['meta_settings']['keys']['google_plus']['value'] ?>" target="_blank">
                        <i class="rounded-x gp fa fa-google-plus"></i>Google Plus
                    </a>
                </li>
            <?php } ?>
            <?php if ($data['meta_settings']['keys']['youtube_channel']['show'] == 1) { ?>
                <li>
                    <a href="<?php echo $data['meta_settings']['keys']['youtube_channel']['value'] ?>" target="_blank">
                        <i class="rounded-x yt fa fa-youtube"></i>Youtube
                    </a>
                </li>
            <?php } ?>
            <?php if ($data['meta_settings']['keys']['instagram']['show'] == 1) { ?>
                <li>
                    <a href="<?php echo $data['meta_settings']['keys']['instagram']['value'] ?>" target="_blank">
                        <i class="rounded-x ig fa fa-instagram"></i>Instagram
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>