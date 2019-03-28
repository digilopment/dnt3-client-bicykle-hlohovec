<?php
class imageListModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;
		include "tpl.php";

	}
}

imageListModulController::run();