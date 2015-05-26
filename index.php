<?php
    //set_include_path(".:/usr/lib/php:/usr/local/lib/php:/home/william5/php/includes");
    require_once 'helpers/controlFile.php';
    require_once 'php/db/db_connect.php';
    require_once 'helpers/manageRequest.php';
    require_once 'php/pscript/signInBut.php';    
    
    $page = reqSet('p');    
    
    $incDir = 'php/includes/';
    $snpDir = 'php/snips/';
    $pDir = 'php/pages/';
    
    switch($page){
        case 'h0'://home main            
        case 'h1'://new user request
        case 'h2'://sign in
        case 'h3'://validate email notice
        case 'h4'://welcome new user, email validation success
        case 'h5'://User account already exists
        case 'h6'://forgot password.
        case 'h7'://
            $email = reqSet('qa');
            $hash = reqSet('qh');
            include $pDir.'home/home.php';
            break;
        case 'c0':
        case 'c1':
            include $pDir.'cover/cover.php';
            break;
        default:
            include $pDir.'cover/cover.php';
            break;
    }