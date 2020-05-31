<?php

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;

class searchModulController
{

    public function run()
    {
        $rest = new Rest;
        $db = new DB;
        include "tpl.php";
    }

}

searchModulController::run();
