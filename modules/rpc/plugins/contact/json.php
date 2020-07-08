<?php
echo '{'
. '"success": "' . $this->data['plugin_data']['response'] . '",
    "request": "POST (via AJAX)",
    "response": "' . $this->data['plugin_data']['response'] . '",
    "protokol": "REST",
    "generator": "Dnt3 Platform",
    "service": "ContactPluginControll"
   }';
