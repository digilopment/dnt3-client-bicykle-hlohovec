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
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4 clearfix">
                <i class="fa fa-search search-btn pull-right"></i> 
            </div>
        </div>
        <!--/end row-->
    </div>
    <!--/end container-->
</div>
<!-- End Topbar blog -->