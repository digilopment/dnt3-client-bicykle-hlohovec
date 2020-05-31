<?php

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;

class rpcModulController
{

    public function run()
    {
        $rest = new Rest;
        $db = new DB;
        if ($rest->webhook(2) == "json" && $rest->webhook(3) == "contact-form") { //o jeden vyssi webhook ako maximalnz mozny
            include "contact-form.php";
        } else {
            $rest->loadDefault();
        }
    }

}

rpcModulController::run();
