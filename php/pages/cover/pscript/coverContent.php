<?php    
    $linkId = $_POST['linkId'];
    
    if(isset($linkId)){
        switch($linkId){            
            case '1':
                  require '../../../snips/contactUs.php';
                  break;
            case '2':
                  require '../../../snips/signInForm.php';
                  break;            
            default:
                  require '../snips/coverMain_snp.php';
                  break;
        }
    }
