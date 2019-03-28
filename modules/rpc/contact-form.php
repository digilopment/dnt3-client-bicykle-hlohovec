<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$rest = new Rest;
$mailer = new Mailer;
$mail = new Dnt;
$data = Frontend::get();
$db   = new Db;

if($rest->post("sent_msg")){
	
	$predmet 	= "".$rest->post("predmet");
	$meno 		= "".$rest->post("meno");
	$priezvisko = "".$rest->post("priezvisko");
	$firma 		= "".$rest->post("firma");
	$email 		= "".$rest->post("email");
	$tel_c 		= "".$rest->post("tel_c");
	$ulica 		= "".$rest->post("ulica");
	$psc 		= "".$rest->post("psc");
	$mesto 		= "".$rest->post("mesto");
	$produkt 	= "".$rest->post("produkt");
	$od_meno 	= Settings::get("vendor_email")." - ".$predmet;
	$sprava 	= $rest->post("sprava");
	
	
	
	$msg = "
	<h3>".$predmet."</h3><br/>
	<b>Meno:</b>".$meno." ".$priezvisko."<br/>
	<b>Telefón:</b>".$tel_c."<br/>
	<b>Email:</b>".$email."<br/>

	<b>SPRÁVA</b>:
	".$sprava."<br/><br/><b>Kontaktný email odosielateľa: <a href=\"mailto:".$email."\">".$email."</a></b>";
	
	if(Frontend::getMetaSetting($data, "notifikacny_email")){
		$senderEmail 	= Frontend::getMetaSetting($data, "notifikacny_email");
		$messageTitle 	= Frontend::getMetaSetting($data, "title")." - ".MultyLanguage::translate($data, "formular", "translate");
		
		$mailer->set_recipient(array($senderEmail));
		$mailer->set_msg($msg);
		$mailer->set_subject($messageTitle);
		$mailer->set_sender_name("Info");
		$mailer->set_sender_email("info@noreply.sk");
		$mailer->sent_email();
	
	}
				

	
	$name = $predmet.", ".$meno." ".$priezvisko;
	
	/**
	 *ZAPIS DO POSTOV
	**/
	$insertedData = 
	array(
		'vendor_id' 		=> Vendor::getId(), 
		'cat_id' 			=> "306", 
		'sub_cat_id' 		=> "", 
		'`type`' 			=> "post", 
		'datetime_creat' 	=> Dnt::datetime(),
		'datetime_update' 	=> Dnt::datetime(),
		'datetime_publish' 	=> Dnt::datetime(),
		'name' 				=> $name,
		'name_url' 			=> Dnt::name_url($name),
		'content' 			=> $msg,
		'`show`' 			=> '0' 
	);
	$db->insert('dnt_posts', $insertedData);
	
	$RESPONSE = 1;
}else{
	$RESPONSE = 0;
}

echo '
    {
      "success": "'.$RESPONSE.'",
      "request": "POST (via AJAX)",
      "response": "'.$RESPONSE.'",
      "protokol": "REST",
      "generator": "Designdnt 3",
      "service": "rpc/api/json/ajax-ziadost",
      "message": "Silence is golden, speech is gift :)"
    }';
	
