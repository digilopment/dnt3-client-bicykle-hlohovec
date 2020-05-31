<?php

use DntLibrary\Base\Frontend;
use DntLibrary\Base\Vendor;

$data = Frontend::get($custom_data, $id);
include "dnt-view/layouts/" . Vendor::getLayout() . "/tpl_functions.php";
get_top($data);
include "dnt-view/layouts/" . Vendor::getLayout() . "/top.php";
?>


<?php
get_paralax($data['article']['img'], $data['title']);
?>
<div class="margin-bottom-60"></div>
<div class="container margin-bottom-40">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-9 main-content">
            <!-- Dynamic Item -->
            <div class="blog-grid margin-bottom-30">
                <h2 class="title-v4"><?php echo $data['article']['name']; ?></h2>
                <div class="overflow-h margin-bottom-10 article-view">
                    <?php echo $data['article']['perex']; ?>
                    <?php echo $data['article']['content']; ?>
                </div>
            </div>
        </div>
        <!-- Right Sidebar -->
        <div class="col-md-3">
            <?php col_right($data); ?>
        </div>
        <!-- End Right Sidebar -->
    </div>
</div>
<?php
get_footer($data);
get_bottom($data);
