<?php

/**
 * @author gencyolcu
 * @copyright 2015
 */

session_start();
$email = $_POST['email'];

$password = $_POST['password'];

$email_flag = 1;
$pass_flag = 1;

$link = mysqli_connect("localhost", "root", "", "cabbuddy");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "select count(*) from users where (email = '$email' or userid = '$email') and status=1";

 $rs =mysqli_query($link, $sql);;  
 $result = mysqli_fetch_array($rs);
 
 if ($result[0] == 0) {
     echo "User ID/ Email is not registered or Verified";
 }
else{

 $encryptPwd = crypt($password,'st');
 
 $sql = "select password, euserid  from users where (userid = '$email' or email = '$email')";
 $rs = mysqli_query($link, $sql);;  
 $result = mysqli_fetch_array($rs);
 
 if(crypt($password,$result["password"]) == $result["password"]) {
     echo "success".",".$result["euserid"] ;
	 $_SESSION["notify_NextPg"] = 'You have successfully signed in!!!<br> Happy Amigo Hunting';
	 $_SESSION["loggedInUsr"] = $email ;
 }
 else {
 
    echo "Incorrect password for '$email'";
 }
}
?>