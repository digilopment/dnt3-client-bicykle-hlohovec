<div class="blog-topbar">
    <div class="topbar-search-block">
        <div class="container">
            <form action="<?php echo $this->data['plugin_data']['search_url']; ?>">
                <input type="text" name="q" class="form-control" 
                       placeholder="<?php echo $this->data['plugin_data']['translate']('text_to_search'); ?>">
                <div class="search-close"><i class="fa fa-times" aria-hidden="true"></i></div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-xs-8">
                <div class="jazyky">
                    <ul>
                        <li><a href="<?php echo WWW_PATH; ?>"><i class="fa fa-2x fa-home"></i></a></li>
                        <?php
                        /*$lngArr = MultyLanguage::activeVendorLangs();
                        if (count($lngArr) > 1) {
                            foreach (MultyLanguage::activeVendorLangs() as $lg) {
                                $urlLg = WWW_PATH . "" . $lg . "/" . $rest->webhook(1);
                                ?>
                                <li>
                                    <a href="<?php echo $urlLg; ?>" >
                                        <img src="<?php echo WWW_PATH . "dnt-view/layouts/wp_tpl_2/images/flags/flag_" . $lg . ".png"; ?>" alt="<?php echo $lg; ?>"></a>
                                </li>
                                <?php
                            }
                        }*/
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4 clearfix">
                <i class="fa fa-search search-btn pull-right"></i> 
                <?php /* <ul class="topbar-list topbar-log_reg pull-right visible-sm-block visible-md-block visible-lg-block">
                  <li class="cd-log_reg home"><a class="cd-signin" href="javascript:void(0);"><?php echo $translate['prihlasit'];?></a></li>
                  </ul> */ ?>
            </div>
        </div>
        <!--/end row-->
    </div>
    <!--/end container-->
</div>
<!-- End Topbar blog -->