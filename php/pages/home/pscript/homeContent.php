<?php    
    $linkId = $_POST['linkId'];
    
    if(isset($linkId)){
        switch($linkId){
            case '0':
                  require 'coverMain_snp.php';
                  break;
            case '1':
                  require 'coverContact_snp.php';
                  break;
            case '2':
                  require 'signInForm.php';
                  break;            
            default:
                  require 'coverMain_snp.php';
                  break;
        }
    }
