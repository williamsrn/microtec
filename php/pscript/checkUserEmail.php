<?php
require_once '../db/db_connect.php';
// Catch results sent via $.post and assigns them to php variables.
$email = $conn->escape_string($_POST['email']);

// Check to see if email exists
$sql = "SELECT * FROM user WHERE email = '$email'";
$conn->prepare($sql);
$result = $conn->query($sql);
$rowCnt = $result->num_rows;
if($rowCnt > 0){
    echo 'exists';
}else{
    echo 'new';
}

$conn->close();