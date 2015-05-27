<?php
if($isLive){
    set_include_path(".:/usr/lib/php:/usr/local/lib/php:/home/william5/php/includes");
}

include_once 'php/db/db_connect.php';
include_once 'helpers/mtSecurity.php';
include_once 'helpers/manageRequest.php';
require 'PHPMailer-master/PHPMailerAutoload.php';

//var_dump($_POST);

$name = $conn->escape_string($_POST['name']);
$email = $conn->escape_string($_POST['email']);
$subj = $conn->escape_string($_POST['subject']);
$msg = $conn->escape_string($_POST['message']);

if ( isThreat($name) ||  isThreat($email) || 
    isThreat($subj) ||  isThreat($msg) ){
 // [... direct user to an error page and quit ...]
 // [... see http://www.thesitewizard.com/archive/feedbackphp.shtml ...]
 // [... if you don't know how to do this ...]

}

//check if user email exists
$sql = "SELECT ID, email from user WHERE email='$email'";
$conn->prepare($sql);
$result = $conn->query($sql);
//var_dump($result);
$rowCnt = $result->num_rows;
if($rowCnt > 0){
    //record exists
    $row = $result->fetch_assoc();
    $userId = $row['ID'];       
}else{
    //create new user record (non-active)
    $sql = "INSERT INTO users (email) " . "VALUES ('$email)";
    if ($conn->query($sql) === true){
        $userId = $conn->insert_id;
    }
}
$result->close(); 
//echo "userId: $userId";
$sql = "INSERT INTO contact_us_msg (user_id, name_on_msg, subject_id, msg) VALUES ('$userId', '$name', '$subj', '$msg')"; 
if($conn->query($sql) === true){
    $mail = new PHPMailer;

    //SMTP DEBUG 0,1,2,3,4
    //$mail->SMTPDebug = 3;                                 // Enable verbose debug output
    //$mail->Debugoutput = 'html'; 
    
    
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $message = 'We have recieved an inquiry via ContactUs page.  Details to follow: <br><br>'
            . 'Name:  ' . $name . '<br>'
            . 'Email:  ' .$email . '<br>'
            . 'Subject:  ' . $subj . '<br>'
            . 'Message:  ' . $msg;
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
    $mail->FromName = 'MicroTec ContactUs';
    $mail->addAddress('microtecconsulting@outlook.com', 'ContactUs');                   // Add a recipient
    $mail->addReplyTo('webmaster@microtecconsulting.com', 'Information');
    $mail->isHTML(true);                                   // Set email format to HTML
    $mail->Subject = 'Contact Us Message';
    $mail->Body    = $message;                              //HTML Message  (if true)
    $mail->AltBody = 'alt body message';
    try {
        $success = $mail->send();

        if($success) {
        ?>
            <div>
                <h4>Your message was successfully sent.</h4>
                <p>Thank you for your inquiry.  We will respond shortly to the email you provided, <?php echo $email ?>.</p>
            </div>
        <?php
        }else{
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

    } catch (Exception $ex) {    
        echo $ex;      
    }
}else{
?>
    <div>
        <h4>There was a problem sending the message</h4>
        <p>We apologize for the inconvenience.</p><p>Please try again later or feel free to contact us using the phone numbers or email listed above.</p>
    </div>
<?php
} 
$conn->close();