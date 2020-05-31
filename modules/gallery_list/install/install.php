<?php

use DntLibrary\Base\Vendor;

function defaultModuleMetaDataConfiguration($postId, $service)
{

    $defaultContent = "";
    $insertedData[] = array(
        '`post_id`' => $postId,
        '`service`' => $service,
        '`vendor_id`' => Vendor::getId(),
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
