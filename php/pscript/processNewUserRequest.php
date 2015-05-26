<?php
require_once '../db/db_connect.php';
include_once 'helpers/mtSecurity.php';
include_once 'helpers/manageRequest.php';
require 'PHPMailer-master/PHPMailerAutoload.php';

//var_dump($_POST);

$fname = $conn->escape_string($_POST['fName']);
$lname = $conn->escape_string($_POST['lName']);
$coname = $conn->escape_string($_POST['coName']);
$email = $conn->escape_string($_POST['inputEmail']);
$rand = rand(0,1001001);
$hash = md5($rand); 
//$password = rand(1000,5000);
$pass = $conn->escape_string($_POST['inputPassword']);
$fullName = $fname . $lname;

if ( isThreat($fname) ||  isThreat($lname) || 
    isThreat($coname) ||  isThreat($email) || isThreat($pass)){


 // [... direct user to an error page and quit ...]
 // [... see http://www.thesitewizard.com/archive/feedbackphp.shtml ...]
 // [... if you don't know how to do this ...]

}


$str0 = substr($hash, 0, 1);
$aLen = count($hT);
$pos = 0;
while($pos < $aLen){
    if($str0 === $hT[$pos]){
        break;
    }
    $pos++;
}
$str1 = substr($hash, 0, $pos);
$str2 = substr($hash, $pos);
$concat = $str1 . $pass . $str2;
$hashed = md5($concat);

//echo "str0= $str0<br>";
//echo "pos= $pos<br>";
//echo "str1= $str1<br>";
//echo "str2= $str2<br>";
//echo "hash= $hash<br>";
//echo "s12= $str1" . "$str2<br>";
//echo "concat= $concat<br>";
//echo "hashed= $hashed<br>";
//check if user email exists
$sql = "SELECT ID, email from users WHERE email='$email'";
$conn->prepare($sql);
$result = $conn->query($sql);
$rowCnt = $result->num_rows;
if($rowCnt > 0){
    //record exists
    $row = $result->fetch_assoc();
    $userId = $row['ID'];
    $sql = "UPDATE user SET first_name='$fname', last_name='$lname', corp_name='$coname', hashed=$hashed', hash='$hash', active=1 WHERE ID=$userId";
}else{
    //create new user record (active)
    $sql = "INSERT INTO user (first_name, last_name, corp_name, email, hashed, hash, active) VALUES ('$fname', '$lname', '$coname', '$email', '$hashed', '$hash', 1)";
}
$result->close();

if ($conn->query($sql) === true) {
    if($isLive){
        $verifyAddy = "http://www.microtecconsulting.com/index.php?p=h4&qa=$email&qh=$hash";
    }else{
        $verifyAddy = "http://localhost/MicroTec/index.php?p=h4&qa=$email&qh=$hash";
    }
    
    // message
    $message = "<html>
                    <head>
                        <title>MicroTec email confirmation link</title>
                    </head>
                    <body>
                        <p>Hello $fname!</p>
                        <p>Please click the link below to confirm your email and complete the registration process.<br>
                            You will be automatically redirected to a welcome page where you can then sign in.
                        </p>
                        <a href='$verifyAddy'>Click Here </a> to complete registration.
                    </body>
                </html>";
    
    $mail = new PHPMailer;

    //SMTP DEBUG 0,1,2,3,4
    //$mail->SMTPDebug = 3;                                 // Enable verbose debug output
    //$mail->Debugoutput = 'html'; 
    
    
    $mail->isSMTP();                                        // Set mailer to use SMTP
    
    if($isLive){
        /* PROD */
        $mail->Host = 'a2ss15.a2hosting.com';                   // Specify main and backup SMTP servers                                    
        $mail->Username = 'william5';                           // SMTP username
        $mail->Password = 'host*!1';                            // SMTP password
    }else{
        /* LOCAL */
        $mail->Host = 'smtp-mail.outlook.com';                  // Specify main and backup SMTP servers                                    
        $mail->Username = 'microtecconsulting@outlook.com';     // SMTP username
        $mail->Password = 'mtcrnw123';                          // SMTP password
    }
    
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                      // TCP port to connect to
    $mail->From = 'webmaster@microtecconsulting.com';
    $mail->FromName = 'MicroTec';
    $mail->addAddress($email, $fullName);                   // Add a recipient
    $mail->addReplyTo('webmaster@microtecconsulting.com', 'Information');
    $mail->isHTML(true);                                   // Set email format to HTML
    $mail->Subject = 'Account registration confirmation';
    $mail->Body    = $message;                              //HTML Message  (if true)
    $mail->AltBody = 'alt body message';
try {
    $success = $mail->send();
    
    if($success) {
        if($isLive){
            $loc = "/index.php?p=h3&qa=$email";
        }else{
            $loc = "$dynaUrl/index.php?p=h3&qa=$email";
        }
        //echo $sql;
        header('Location:'.$loc);
    }else{
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
            
} catch (Exception $ex) {    
    echo $ex;      
}
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();