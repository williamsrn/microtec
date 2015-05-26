<?php
include_once 'db_connect.php';
//var_dump($_POST);

$email = $conn->escape_string($_POST['inputEmail']);
$pass = $conn->escape_string($_POST['inputPassword']);

if ( isThreat($email) || isThreat($pass)){
 // [... direct user to an error page and quit ...]
 // [... see http://www.thesitewizard.com/archive/feedbackphp.shtml ...]
 // [... if you don't know how to do this ...]
}

        
$sql = "SELECT * FROM users WHERE email='$email'"; 

echo "sql:  $sql<br>";
$result = $conn->query($sql);        
//printf("Select returned %d rows.\n", $result->num_rows);
if($result->num_rows > 0){
    //We have a match
    //echo 'We have a match<br>';
    $row            = $result->fetch_assoc();
    $memberNum      = $row['ID'];
    $fname          = $row['first_name'];//NEED FIXNULL FUNCTION
    $lname          = $row['last_name'];
    $corp           = $row['corp_name'];
    $storedEmail    = $row['email'];
    $phash          = $row['hashed'];
    $addy1          = $row['address1'];
    $addy2          = $row['address2'];
    $city           = $row['city'];
    $stateId        = $row['state_ID'];
    $zip1           = $row['zip1'];
    $zip2           = $row['zip2'];
    $p1             = $row['phone1'];
    $p1Ty           = $row['phone1_type'];
    $p2             = $row['phone2'];
    $p2Typ          = $row['phone2_type'];
    $verified       = $row['verified'];
    $active         = $row['active'];
    $banned         = $row['banned'];
    $hash           = $row['hash'];

    //echo "memberNum: $memberNum  -- active: $active";
    $result->close();
    if (0 === (int)$active) {
         //Account not activated, check if verified
        if(0 === (int)$verified){
            //account never activated
            echo "Account activation required. Please check email for activation email";
            echo "Send a new activation email";//semd new email -- update hash and password with new email activation.  May need to store old/new hash
        }else{
            //account inactive
            echo "Account activation required. Account is inactive";
            echo "Reactivate account";//semd new email -- update hash and password with new email activation.  May need to store old/new hash
        }

    }else if(0 === (int)$verified){
        //acount is active, not verified
        //Future Use....
        //this cannot happen at this point in time
    }else if(1 === (int)$banned){
        echo "Account has been banned.";
        echo 'If you think this is in error.  Please contact webmaster @';
    }else{
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
        
        if($hashed !== $phash){
            echo 'invalid password!';
        }else{
            echo 'password was valid!!';
            //create session
        }
    }
}else{
    // No match -> invalid email
    echo '<div class="statusmsg">That is an invalid email</div>';
}
?>