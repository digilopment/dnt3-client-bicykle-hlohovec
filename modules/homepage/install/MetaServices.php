<?php

namespace DntView\Layout\Modul\Install;

use DntLibrary\Base\Vendor;

class MetaServices
{

    protected $content = '';

	public function __construct()
    {
        $this->vendor = new Vendor();
    }
	
    public function init($postId, $service)
    {
        $defaultContent = $this->content;
		
        $insertedData[] = array(
			'`post_id`' => $postId,
			'`service`' => $service,
			'`vendor_id`' => $this->vendor->getId(),
			'`key`' => "gallery",
			'`value`' => $defaultContent,
			'`content_type`' => "image",
			'`cat_id`' => "3",
			'`description`' => "Galéria",
			'`order`' => "10",
			'`show`' => "1",
		);
        return $insertedData;
    }

}