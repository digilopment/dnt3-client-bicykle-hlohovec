<?php

namespace DntView\Layout;

use DntLibrary\Base\Vendor;
use DntLibrary\Base\Webhook;

class Configurator extends Webhook
{

    public function modulesRegistrator()
    {
        $modulesRegistrator = array(
            'singl_page' => array_merge(
                    array(), $this->getSitemapModules('singl_page')
            ),
            'search' => array_merge(
                    array(), $this->getSitemapModules('search')
            ),
            'clean' => array_merge(
                    array(), $this->getSitemapModules('clean')
            ),
            'homepage' => array_merge(
                    array(), $this->getSitemapModules('homepage')
            ),
            'contact' => array_merge(
                    array(), $this->getSitemapModules('contact')
            ),
            'article_view' => array_merge(
                    array(), array('{alphabet}/detail/{digit}/{eny}')
            ),
            'article_list' => array_merge(
                    array(), $this->getSitemapModules('article_list')
            ),
            'image_list' => array_merge(
                    array(), $this->getSitemapModules('image_list')
            ),
            'auto_redirect' => array_merge(
                    array(), array('a/{digit}')
            ),
            'video_embed' => array_merge(
                    array(), array('embed/video/{digit}')
            ),
            'rpc' => array_merge(
                    array(), array('rpc/json/{alphabet}')
            ),
            'product_detail' => array_merge(
                    array(), array('{alphabet}/product/{digit}/{eny}')
            ),
            'eshop_list' => array_merge(
                    array(), $this->getSitemapModules('eshop_list')
            ),
        );
        return $modulesRegistrator;
    }

    public function modulesConfigurator()
    {
        return array(
            'singl_page' => array(
                'service_name' => 'Singl Page',
            ),
            'search' => array(
                'service_name' => 'Vyhľadávanie',
            ),
            'clean' => array(
                'service_name' => 'Clean',
            ),
            'homepage' => array(
                'service_name' => 'Homepage',
            ),
            'contact' => array(
                'service_name' => 'Kontakt',
            ),
            'article_list' => array(
                'service_name' => 'Article List',
            ),
            'image_list' => array(
                'service_name' => 'Image List',
            ),
            'product_detail' => array(
                'service_name' => 'Detail Produktu',
            ),
            'eshop_list' => array(
                'service_name' => 'Zoznam produktov',
            ),
        );
    }

    public function metaSettings()
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

}
