<?php

namespace DntView\Layout\Modul\Install;

use DntLibrary\Base\Vendor;

class MetaServices
{

    protected $content = '';

    public function init($postId, $service)
    {
        $defaultContent = $this->content;

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'price',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Cena produktu',
            '`order`' => '100',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'isInShop',
            '`value`' => $defaultContent,
            '`content_type`' => 'bool',
            '`cat_id`' => '2',
            '`description`' => 'Je produkt na predajni?',
            '`order`' => '200',
            '`show`' => '0',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'isInStock',
            '`value`' => $defaultContent,
            '`content_type`' => 'bool',
            '`cat_id`' => '2',
            '`description`' => 'Je produkt na sklade?',
            '`order`' => '300',
            '`show`' => '0',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'year',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Rok',
            '`order`' => '400',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'catalogue_price',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Katalógová cena produktu',
            '`order`' => '500',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'purchase_price',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Veľkoonchodná cena',
            '`order`' => '600',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'variants',
            '`value`' => $defaultContent,
            '`content_type`' => 'json',
            '`cat_id`' => '2',
            '`description`' => 'Varianty produktu',
            '`order`' => '700',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'variant',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Variant (veľkosť, farba...)',
            '`order`' => '800',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'dataSource',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Zdroj dát',
            '`order`' => '900',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'code',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Kód produktu',
            '`order`' => '1000',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'variants',
            '`value`' => $defaultContent,
            '`content_type`' => 'json',
            '`cat_id`' => '2',
            '`description`' => 'Varianty produktu',
            '`order`' => '1100',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'productId',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'ID Produktu v importe',
            '`order`' => '1200',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'groupId',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Skupinové ID (označuje skupinu s rovnakým ID)',
            '`order`' => '1300',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'manufacturer',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Značka produktu',
            '`order`' => '1400',
            '`show`' => '1',
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => 'originalImage',
            '`value`' => $defaultContent,
            '`content_type`' => 'text',
            '`cat_id`' => '2',
            '`description`' => 'Url originálneho obrázka',
            '`order`' => '1500',
            '`show`' => '1',
        );
        
        return $insertedData;
    }

}
