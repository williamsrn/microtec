<?php
    //set_include_path(".:/usr/lib/php:/usr/local/lib/php:/home/william5/php/includes");
    require_once 'helpers/controlFile.php';
    require_once 'helpers/mtSecurity.php';
    if($isLive){
        /* PROD */
        $servername = "localhost";
        $username = "william5_rnwilis";
        $password = "mysqL*!1";
        $dbase = "william5_microtec";    
    }else{
        /*DEV*/
        $servername = "localhost";
        $username = "rnwilis";
        $password = "willy";
        $dbase = "microtec";
    }

    $conn = new mysqli($servername, $username, $password, $dbase);
    //var_dump(function_exists('mysqli_connect'));

    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }