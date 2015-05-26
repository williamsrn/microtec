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
        <link href="jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        
        <link href="css/signin.css" rel="stylesheet" type="text/css"/>
        <link href="css/micro.css" rel="stylesheet" type="text/css"/>
        
        <!-- Custom styles for this template -->        
        <link href="php/pages/cover/css/cover.css" rel="stylesheet" type="text/css"/>
        
        
        <script src="bootstrap-3.3.4/js/ie-emulation-modes-warning.js" type="text/javascript"></script>        
                
    </head>
    <?php 
        echo getcwd() . "\n";
        $page = reqSet('p');
        $page = substr($page, 1);
        if(strlen($page) == 0)
            $page = 0;
        $arg = array('','','');
        $arg[$page] = 'active';        
    ?>
    <body>
        <input id="pId" type="hidden" value="0">
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    <header class="masthead clearfix">
                        <div class="inner">
                            <div class="masthead-brand logo"><img src="img/logo_v6.png" alt=""/>&nbsp;<a  href="javascript: screensize();" >LLC</a></div>
                            <nav id="nav">
                                <ul class="nav masthead-nav">
                                    <li class="<?php echo $arg[0]; ?>" data-lnk="0"><a href="index.php?c=1">Home</a></li>
                                    
                                    <li class="<?php echo $arg[1]; ?>" data-lnk="1"><a href="./Cover2_files/Cover2.html">Contact</a></li>
                                    
                                    <li class="<?php echo $arg[2]; ?>" data-lnk="2" id="sin"><a href="signInPage.php">Sign In</a></li>
                                </ul>
                            </nav>
                        </div>
                    </header>
                    <div id="slick" class="inner cover">
                    <?php
                        switch($page){
                            case '0':
                                include 'snips/coverMain_snp.php';
                                break;                
                            case '1':
                                include 'php/snips/contactUs.php';
                                break;           
                            case '2':
                                include '../../snips/signInForm.php';
                                break;                            
                            default:
                                include 'snips/coverMain_snp.php';
                                break;
                        }
                    ?>
                    </div>
                    <div class="mastfoot">
                        <div class="inner">                          
                            <p>© 2015 <a href="./">MicroTec <span>LLC</span></a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--                Core JavaScript               -->
<!--  ====================================================  -->
<!-- Placed at the end of the document so the pages load faster -->

    <!-- Page Specific JS -->
    <script src="php/pages/cover/js/micro.js" type="text/javascript"></script>
    
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
