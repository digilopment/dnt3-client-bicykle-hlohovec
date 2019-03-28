<?php
class rpcModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;
		if($rest->webhook(2) == "json" && $rest->webhook(3) == "contact-form"){ //o jeden vyssi webhook ako maximalnz mozny
			include "contact-form.php";
		}else{
			$rest->loadDefault();
		}
	}
	
}

rpcModulController::run();