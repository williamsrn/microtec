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
?>
    <div>
        <h4>Your message was successfully sent.</h4>
        <p>Thank you for your inquiry.  We will respond shortly to the email you provided, <?php echo $email ?>.</p>
    </div>
<?php
}else{
?>
    <div>
        <h4>There was a problem sending the message</h4>
        <p>We apologize for the inconvenience.</p><p>Please try again later or feel free to contact us using the phone numbers or email listed above.</p>
    </div>
<?php
} 
$conn->close();