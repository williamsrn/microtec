<?php
    $isLive = false; //true = remote host (production) : false = local host (development)
    $dynaUrl;
    if($isLive){
        //remote server
        set_include_path(".:/usr/lib/php:/usr/local/lib/php:/home/william5/php/includes");
        $dynaUrl = '/MicroTec';
    }else{
        //loaclhost
        $dynaUrl = 'http://localhost/MicroTec';
    }