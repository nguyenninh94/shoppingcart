<?php

return [
  'client_id' => 'ASAfdsw1etvecLQ_p7QGUX41xhcXfyz-avKDlSj-E2qaok8V0R70rbbBekIVIF9GXA7u6DN1Agh0lR6Q',
  'secret' => 'ELBlCUkOdNPiRYIzyHvLr0vUKRh_2_iWFjD5TyF2q42b58LJJn30OwElyQKaDMeSN63FVRyr_NRdYtu5',
  'settings' => [    
        'mode' => 'sandbox',
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
	    'log.LogLevel' => 'INFO', 
	    'http.CURLOPT_CONNECTTIMEOUT' => 30
  ]
];