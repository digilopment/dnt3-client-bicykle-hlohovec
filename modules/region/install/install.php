<?php
function defaultModuleMetaDataConfiguration($postId, $service){
	
	$defaultContent	= "Content";
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "name", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Názov v rámci stránky", 
		'`order`' 			=> "100", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "text_1", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "content",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Text", 
		'`order`' 			=> "200", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "text_2", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "content",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Text 2", 
		'`order`' 			=> "300", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "galeria_1", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "image",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Galéria fotografii", 
		'`order`' 			=> "400", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "mapa", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Sekcia Mapa -> Názov sekcie", 
		'`order`' 			=> "500", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "youtube_embed", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Youtube video", 
		'`order`' 			=> "600", 
		'`show`' 			=> "1", 
	);
	return $insertedData;
	
}