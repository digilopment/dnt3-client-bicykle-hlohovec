<?php

namespace DntView\Layout\Modul\Install;

use DntLibrary\Base\Vendor;

class MetaServices
{

    protected $content = '0';
	
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
            '`key`' => "zakladne_informacie",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Základné informácie",
            '`order`' => "100",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "pravne_zaklady",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Právne základy spracúvania osobných údajov",
            '`order`' => "200",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "informacna_povinnost",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Informačná povinnosť pre zamestnanca",
            '`order`' => "300",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "spracovatelske_cinnosti",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Spracovateľské činnosti",
            '`order`' => "400",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "prava_osoby",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Práva dotknutej osoby",
            '`order`' => "500",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "kurierske_spolocnosti",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Kurierske a doručovateľské spoločnosti",
            '`order`' => "600",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "zacatie_konania",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Návrh na začatie konania",
            '`order`' => "700",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "cookies",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Cookies",
            '`order`' => "800",
            '`show`' => "1",
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "obchodne_podmienky",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Obchodné podmienky",
            '`order`' => "900",
            '`show`' => "1",
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "reklamacny_poriadok",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Reklamačný poriadok",
            '`order`' => "900",
            '`show`' => "1",
        );

        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "reklamacny_formular",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Reklamačný formular",
            '`order`' => "900",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "formular_odstupenia",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Formulár odstúpenia od zmluvy",
            '`order`' => "900",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => $this->vendor->getId(),
            '`key`' => "kontakt",
            '`value`' => '',
            '`content_type`' => "text",
            '`cat_id`' => "2",
            '`description`' => "Kontaktné údaje",
            '`order`' => "900",
            '`show`' => "1",
        );
        return $insertedData;
    }

}
