<?php

namespace DntView\Layout;

use DntLibrary\App\Modul;
use DntLibrary\Base\Vendor;

class Configurator extends Modul
{

	public function __construct(){
		parent::__construct();
		$this->vendor = new Vendor();
	}
	
    public function modulesRegistrator()
    {
        $this->getSitemap();
        
        // Optimalizované: načítame všetky moduly naraz z už načítanej sitemapy
        $services = array(
            'singl_page' => 'singl_page',
            'clean' => 'clean',
            'homepage' => 'homepage',
            'contact' => 'contact',
            'article_list' => 'article_list',
            'image_list' => 'image_list',
            'product_list' => 'product_list',
            'business_conditions' => 'business_conditions',
        );
        
        $sitemapModules = $this->getSitemapModulesBatch($services);
        
        $modulesRegistrator = array(
            'singl_page' => array_merge(
                    array(), $sitemapModules['singl_page'] ?? array()
            ),
            'clean' => array_merge(
                    array(), $sitemapModules['clean'] ?? array()
            ),
            'homepage' => array_merge(
                    array(), $sitemapModules['homepage'] ?? array()
            ),
            'contact' => array_merge(
                    array(), $sitemapModules['contact'] ?? array()
            ),
            'article_view' => array_merge(
                    array(), array('{alphabet}/detail/{digit}/{eny}')
            ),
            'add_to_cart' => array_merge(
                    array(), array('cart/add/{digit}')
            ),
            'article_list' => array_merge(
                    array(), $sitemapModules['article_list'] ?? array()
            ),
            'image_list' => array_merge(
                    array(), $sitemapModules['image_list'] ?? array()
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
            'product_list' => array_merge(
                    array(), $sitemapModules['product_list'] ?? array()
            ),
            'business_conditions' => array_merge(
                    array(), $sitemapModules['business_conditions'] ?? array()
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
            'product_list' => array(
                'service_name' => 'Zoznam produktov',
            ),
            'business_conditions' => array(
                'service_name' => 'Obchodné podmienky',
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
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'social_wall',
            '`key`' => 'facebook_post_sw',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Facebook Post Social Wall',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'social_wall',
            '`key`' => 'instagram_sw',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Instagram Post Social Wall',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'social_wall',
            '`key`' => 'youtube_sw',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Youtube Social Wall',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'social_wall',
            '`key`' => 'twitter_sw',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Twitter Social Wall',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'send_grid_api_key',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Api key pre Send grid',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'send_grid_api_template_id',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Template ID pre Send grid',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'automatic_voucher',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Automatické odosielanie voucherov',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'google_maps_token',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Autorizačný token pre Google Maps',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'vendor',
            '`key`' => 'c_ziv_reg',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Číslo živnostnenského registra',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'vendor',
            '`key`' => 'vendor_sidlo_street',
            '`value`' => 'D. Jurkoviča 900/91',
            '`content_type`' => 'text',
            '`description`' => 'Sídlo firmy - ulica',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'vendor',
            '`key`' => 'vendor_sidlo_psc',
            '`value`' => '920 03',
            '`content_type`' => 'text',
            '`description`' => 'Sídlo firmy - psc',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'vendor',
            '`key`' => 'vendor_sidlo_city',
            '`value`' => 'Hlohovec m.č. Šulekovo',
            '`content_type`' => 'text',
            '`description`' => 'Sídlo firmy - mesto',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '10',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'smtp_host',
            '`value`' => 'smtp.gmail.com',
            '`content_type`' => 'text',
            '`description`' => 'SMTP Host',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '160',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'smtp_username',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'SMTP User name (email)',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '170',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'smtp_password',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'SMTP heslo',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '10',
        );

        return $insertedData;
    }

}
