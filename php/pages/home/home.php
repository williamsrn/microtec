<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="microTec LLC">
        <link rel="icon" href="img/favicon.gif">
        <link rel="shortcut icon" href="img//favicon.gif" type="image/x-icon"/>
        <title>&micro;Tec LLC</title>

        <!-- Core CSS -->
        <!-- DEV 
        <link href="bootstrap-3.3.4/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="jquery-ui-1.11.4/jquery-ui.css" rel="stylesheet" type="text/css"/>
        -->

        <!-- PROD -->
        <link href="bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- <link href="jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet" type="text/css"/> -->
        
        
        <link href="php/pages/home/css/carousel.css" rel="stylesheet" type="text/css"/>
        <link href="css/signin.css" rel="stylesheet" type="text/css"/>
        <link href="css/micro.css" rel="stylesheet" type="text/css"/>

        <!-- Custom styles for this template --><!-- Custom styles for this template -->        
        <link href="php/pages/home/css/micro.css" rel="stylesheet" type="text/css"/>
        
        
        <script src="bootstrap-3.3.4/js/ie-emulation-modes-warning.js" type="text/javascript"></script> 
    </head>
    <body>
        
        <input id="pId" type="hidden" value="1">
        <?php
            $page = reqSet('p');
            $page = substr($page, 1);
            if(strlen($page) == 0)
                $page = 0;
            include $incDir.'/navigation.php';
            
            switch($page){
                case '0':
                    include 'snips/homeMain_snp.php';
                    break;                
                case '1':
                    include 'snips/homeSignUp_snp.php';
                    break;           
                case '2':
                    include 'snips/homeSignIn_snp.php';
                    break;
                case '3':
                    include 'snips/validateEmail_snp.php';
                    break;
                case '4':
                    include 'validateAccount.php';                    
                    break;
                case '5':
                    include 'snips/userAccExists_snp.php';
                    break;
                default:
                    include $pDir.'cover/cover.php';
                    break;
            }
        ?>
            <!-- New User Modal -->
                <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
                    <?php include 'php/modals/newUserModal.php' ?>
                </div>
                <!-- Sign In Modal -->
                <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInLabel" aria-hidden="true">
                    <?php include 'php/modals/signInModal.php' ?>
                </div>
        <?php   
            require $incDir.'footer.php';
        ?>        
        
        <svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="visibility: hidden; position: absolute; top: -100%; left: -100%;">
        <defs></defs>
        <text x="0" y="23" style="font-weight:bold;font-size:23pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle">500x500</text>
        </svg>

        <!--                Core JavaScript               -->
        <!--  ====================================================  -->
        <!-- Placed at the end of the document so the pages load faster -->

        
        <!-- Page Specific JS -->
        <script src="php/pages/home/js/micro.js" type="text/javascript"></script>
        
        
        <!-- DEV 
        <script src="js/jquery-2.1.3.js" type="text/javascript"></script>
        <script src="bootstrap-3.3.4/js/bootstrap.js" type="text/javascript"></script>
        <script src="jquery-ui-1.11.4/jquery-ui.js" type="text/javascript"></script>
        -->    

        <!-- PROD -->
        <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="bootstrap-3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- <script src="jquery-ui-1.11.4/jquery-ui.min.js" type="text/javascript"></script> -->


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->    
        <script src="bootstrap-3.3.4/js/ie10-viewport-bug-workaround.js" type="text/javascript"></script>
        <script src="js/micro.js" type="text/javascript"></script>
    </body>
</html>