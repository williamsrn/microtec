<?php
    function getSignInForm(){
        echo '<div id="frmContain" class="">';            
        include_once 'php/snips/signInForm.php';
        echo '</div>';
    }

    if(isset($_GET['qa']) && !empty($_GET['qa']) AND isset($_GET['qh']) && !empty($_GET['qh'])){
        // Verify data
        $email = $conn->escape_string($_GET['qa']); // Set email variable
        $hash = $conn->escape_string($_GET['qh']); // Set hash variable
        $sql = "SELECT first_name, active, verified FROM user WHERE email='".$email."' AND hash='".$hash."'";    
        //echo $search;
        $result = $conn->query($sql);        
        //printf("Select returned %d rows.\n", $result->num_rows);
        if($result->num_rows > 0){
            //We have a match
            $row = $result->fetch_assoc();
            $name = $row['first_name'];
            $active = $row['active'];
            $verified = $row['verified'];
            $result->close();
?>
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
        <input id="pId" type="hidden" value="2">
            <div class="container main">
                <div class="row">                    
<?php
            if (0 === (int)$active) {//may need to check verified also
                 //Account not yet activated, user needs to register first
                               
            }else if(0 === (int)$verified){
                //User has registered, verify his account
                $sql = "UPDATE user SET verified='1' WHERE email='".$email."' AND hash='".$hash."'";
                $result = $conn->query($sql);
                if($result){
?>
                    <div class="">
                        <h4 class='lead'>Welcome Back <?php echo $name ?>!&nbsp;&nbsp;Thanks for taking the time to create an account with us!</h4>
                        <p>Your account has been activated, you can now login.</p>

                        <p>We appreciate your business.  Creating an account gives gives you access to great benefits such as promotions and sales notifications, 
                            new product/service offerings, as well as access to our paid services. Click <a href="#">here</a> for a full list of benefits.
                        </p>
                    </div>
<?php 
                    getSignInForm();
                }else{
?>
                    <div class="">
                        <h4 class='lead'>There was an problem validating your account</h4>
                        <p>Our IT staff has been notified and is looking into the issue.</p>

                        <p>We apologize for the inconvenience.</p>
                        <p>Please try again later or feel free to contact us using the phone numbers or email listed below.</p>
                    </div>
<?php
                    $msg =   '<div>Fatal Error!  Code: 00002</div>';
                }
            }else{
                //account already verified.  User can login
?>
                <div class="">
                    <h4 class='lead'>Welcome Back <?php echo $name ?>!&nbsp;&nbsp;Thanks for taking the time to create an account with us!</h4>
                    <p>Your account was previously activated, you can now login using the credentials you supplied when creating your account.</p>

                    <p>We appreciate your business.  Creating an account gives gives you access to great benefits such as promotions and sales notifications, 
                        new product/service offerings, as well as access to our paid services. Click <a href="#">here</a> for a full list of benefits.
                    </p>
                </div>
<?php
                getSignInForm();
                $msg =  "<div class='lead'>The account has already been activated.</div>";
            }
        }else{
            // No match -> invalid url
?>
            <div class="">
                <h4 class='lead'>Invalid URL</h4>
                <p>Please use the link supplied to your email.</p>
                <p>If you did not receive an email from us, please <a href="/index?c=2">Sign Up</a> for an account.</p>                    
            </div>
<?php
            $msg = '<div class="statusmsg">That is an invalid url to activate this account.</div>';
        }
    }else{
        // Invalid approach
?>
        <div class="">
            <h4 class='error'>Invalid Approach</h4>
            <p>Our IT staff has been notified and is looking into the issue.</p>

            <p>We apologize for the inconvenience.</p>
            <p>Please try again later or feel free to contact us using the phone numbers or email listed below.</p>
        </div>
<?php
        $msg = '<div class="statusmsg">Invalid approach, please use the link that was sent to your email.</div>';
    }
    $conn->close();
?>
    
            </div>
        </div>
        <!-- Sign In Modal -->
        <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInLabel" aria-hidden="true">
<?php 
        include 'php/modals/signInModal.php' 
?>
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