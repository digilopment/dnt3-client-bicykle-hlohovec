<?php

use DntLibrary\Base\Vendor;

$layout = Vendor::getLayout();
get_top($data);
include "dnt-view/layouts/" . $layout . "/top.php";
?>