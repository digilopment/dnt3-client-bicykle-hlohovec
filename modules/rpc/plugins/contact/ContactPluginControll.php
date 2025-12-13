<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\Mailer;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;
use DntLibrary\Base\Vendor;

class ContactPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $data;
    protected $pluginId;
    protected $rest;
    protected $response = 0;
    protected $frontend;
    protected $mailer;
    protected $multilanguage;
    protected $vendor;
    protected $dnt;
    protected $db;
    protected $settings;

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
        $this->data = $data;
        $this->pluginId = $pluginId;
        $this->rest = new Rest();
        $this->frontend = new Frontend();
        $this->mailer = new Mailer();
        $this->multilanguage = new MultyLanguage();
        $this->vendor = new Vendor();
        $this->dnt = new Dnt();
        $this->db = new DB();
        $this->settings = new Settings();
    }

    protected function addHeaders()
    {
        if (!headers_sent()) {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
        }
    }

    protected function getData()
    {
        if ($this->rest->post('sent_msg')) {

            $predmet = $this->rest->post('predmet');
            $meno = $this->rest->post('meno');
            $priezvisko = $this->rest->post('surname');
            $email = $this->rest->post('email');
            $tel_c = $this->rest->post('tel_c');

            $od_meno = $this->settings->get('vendor_email') . ' - ' . $predmet;
            $sprava = $this->rest->post('sprava');

            $msg = '<h3>' . $predmet . '</h3><br/>'
                    . '<b>Meno: </b>' . $meno . ' ' . $priezvisko . '<br/>'
                    . '<b>Telefón: </b>' . $tel_c . '<br/>'
                    . '<b>Email: </b>' . $email . '<br/>'
                    . '<b>SPRÁVA</b>: ' . $sprava . '<br/>'
                    . '<br/>'
                    . '<b>Kontaktný email odosielateľa: <a href="mailto:' . $email . '">' . $email . '</a></b>';

            if ($this->frontend->getMetaSetting($this->data, 'notifikacny_email')) {
                $recipientEmail = $this->frontend->getMetaSetting($this->data, 'notifikacny_email');
                $messageTitle = $this->frontend->getMetaSetting($this->data, 'title') . ' - ' . $this->multilanguage->translate($this->data, 'formular', 'translate');

                $this->mailer->set_recipient(array($recipientEmail));
                $this->mailer->set_msg($msg);
                $this->mailer->set_subject($messageTitle);
                $this->mailer->set_sender_name('Bike4You - Formulár ' . $meno);
                $this->mailer->set_sender_email($email); //EMAIL ODOSIELATELA JE EMAIL ZAKAZNIKA
                $this->mailer->sent_email();
            }
            $name = $predmet . ', ' . $meno . ' ' . $priezvisko;

            $insertedData = array(
                'vendor_id' => $this->vendor->getId(),
                'cat_id' => '306',
                'sub_cat_id' => '',
                '`type`' => 'post',
                'datetime_creat' => $this->dnt->datetime(),
                'datetime_update' => $this->dnt->datetime(),
                'datetime_publish' => $this->dnt->datetime(),
                'name' => $name,
                'name_url' => $this->dnt->name_url($name),
                'content' => $msg,
                '`show`' => '3'
            );
            $this->db->insert('dnt_posts', $insertedData);
            $this->response = 1;
        }
    }

    public function run()
    {
        $this->addHeaders();
        $this->getData();
        $data = $this->data;
        $data['response'] = $this->response;
        $this->layout($this->loc, 'json', $data);
    }

}
