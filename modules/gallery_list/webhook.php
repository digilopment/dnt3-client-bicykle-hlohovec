<?php

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;

class galleryListModulController
{

    public function run()
    {
        $rest = new Rest;
        $db = new DB;
        include "tpl.php";
    }

}

galleryListModulController::run();
