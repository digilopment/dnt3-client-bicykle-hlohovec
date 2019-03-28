<?php
class galleryListModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;
		include "tpl.php";
	}
}

galleryListModulController::run();