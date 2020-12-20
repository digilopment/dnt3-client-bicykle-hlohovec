<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Dnt;

class ColorsPluginControll extends Plugin
{

    protected $loc = __FILE__;

	public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
		$this->data = $data;
        $this->dnt = new Dnt();
    }
	
    public function run()
    {
		$data = $this->data;
		$data['dnt'] = $this->dnt;
        $this->layout($this->loc, 'tpl', $data);
    }

}
