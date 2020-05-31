<?php

use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;

$data = Frontend::get();
$postData = Frontend::getDeafult($data, "article");
if (Dnt::not_html($postData['perex'])) {
    echo Dnt::not_html($postData['perex']);
} else {
    echo $postData['content'];
}