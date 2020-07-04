<?php

use DntLibrary\Base\Vendor;
use DntLibrary\Base\Webhook;

function custom_modules($webhook = false)
{
    if (!$webhook) {
        $webhook = new Webhook;
    }
    /*
      custom modul listeners
     */
    $custom_modules = array(
        //PARTNERI
        'singl_page' => array_merge(
                array(), $webhook->getSitemapModules('singl_page')
        ),
        'search' => array_merge(
                array(), $webhook->getSitemapModules('search')
        ),
        'clean' => array_merge(
                array(), $webhook->getSitemapModules('clean')
        ),
        'homepage' => array_merge(
                array(), $webhook->getSitemapModules('homepage')
        ),
        'contact' => array_merge(
                array(), $webhook->getSitemapModules('contact')
        ),
        'article_view' => array_merge(
                array(), array('{alphabet}/detail/{digit}/{eny}')
        ),
        'article_list' => array_merge(
                array(), $webhook->getSitemapModules('article_list')
        ),
        'image_list' => array_merge(
                array(), $webhook->getSitemapModules('image_list')
        ),
        'gallery_list' => array_merge(
                array(), $webhook->getSitemapModules('gallery_list')
        ),
        //DETAIL
        //product detail
        //AUTOREDIRECT
        'auto_redirect' => array_merge(
                array(), array('a/{digit}')
        ),
        //VIDEO EMBED
        'video_embed' => array_merge(
                array(), array('embed/video/{digit}')
        ),
        //RPC
        'rpc' => array_merge(
                array(), array('rpc/json/{alphabet}')
        ),
        //RPC
        'product_detail' => array_merge(
                array(), array('{alphabet}/product/{digit}/{eny}')
        ),
        'eshop_list' => array_merge(
                array(), $webhook->getSitemapModules('eshop_list')
        ),
    );
    return $custom_modules;
}

function modulesConfig()
{
    return array(
        'singl_page' => array(
            'service_name' => 'Singl Page',
            'sql' => ''
        ),
        'search' => array(
            'service_name' => 'Vyhľadávanie',
            'sql' => ''
        ),
        'clean' => array(
            'service_name' => 'Clean',
            'sql' => ''
        ),
        'homepage' => array(
            'service_name' => 'Homepage',
            'sql' => ''
        ),
        'contact' => array(
            'service_name' => 'Kontakt',
            'sql' => ''
        ),
        'article_list' => array(
            'service_name' => 'Article List',
            'sql' => ''
        ),
        'image_list' => array(
            'service_name' => 'Image List',
            'sql' => ''
        ),
        'product_detail' => array(
            'service_name' => 'Detail Produktu',
        ),
        'gallery_list' => array(
            'service_name' => 'Galéria',
            'sql' => ''
        ),
        'eshop_list' => array(
            'service_name' => 'Zoznam produktov',
            'sql' => ''
        ),
    );
}

function websettings()
{
    $insertedData[] = array(
        '`type`' => 'social_wall',
        '`key`' => 'facebook_page_sw',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Facebook Page Social Wall',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'social_wall',
        '`key`' => 'facebook_post_sw',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Facebook Post Social Wall',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'social_wall',
        '`key`' => 'instagram_sw',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Instagram Post Social Wall',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'social_wall',
        '`key`' => 'youtube_sw',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Youtube Social Wall',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'social_wall',
        '`key`' => 'twitter_sw',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Twitter Social Wall',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'keys',
        '`key`' => 'send_grid_api_key',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Api key pre Send grid',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'keys',
        '`key`' => 'send_grid_api_template_id',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Template ID pre Send grid',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'keys',
        '`key`' => 'automatic_voucher',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Automatické odosielanie voucherov',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'keys',
        '`key`' => 'google_maps_token',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Autorizačný token pre Google Maps',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'vendor',
        '`key`' => 'c_ziv_reg',
        '`value`' => '',
        '`content_type`' => 'text',
        '`description`' => 'Číslo živnostnenského registra',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '0',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'vendor',
        '`key`' => 'vendor_sidlo_street',
        '`value`' => 'D. Jurkoviča 900/91',
        '`content_type`' => 'text',
        '`description`' => 'Sídlo firmy - ulica',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '1',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'vendor',
        '`key`' => 'vendor_sidlo_psc',
        '`value`' => '920 03',
        '`content_type`' => 'text',
        '`description`' => 'Sídlo firmy - psc',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '1',
        '`order`' => '10',
    );
    $insertedData[] = array(
        '`type`' => 'vendor',
        '`key`' => 'vendor_sidlo_city',
        '`value`' => 'Hlohovec m.č. Šulekovo',
        '`content_type`' => 'text',
        '`description`' => 'Sídlo firmy - mesto',
        '`vendor_id`' => Vendor::getId(),
        '`show`' => '1',
        '`order`' => '10',
    );

    return $insertedData;
}
