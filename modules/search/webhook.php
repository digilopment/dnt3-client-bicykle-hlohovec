<?php
class searchModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;
		include "tpl.php";
	}
	
}

searchModulController::run();