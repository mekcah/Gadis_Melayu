<?php
$userID = $_POST['userID'];
$userPwd = $_POST['userPwd'];

$host = "localhost";
$username = "root";
$password = ""; 
$dbname = "gadismelayu_db";

$link = new mysqli($host, $username, $password, $dbname);
if ($link->connect_error) { 
 die("Connection failed: " . $link->connect_error); 

}
else
{
 $queryCheck = "select * from USER where UserID = '".$userID."' and User_Status = 'active' ";
 $resultCheck = $link->query($queryCheck);
 if ($resultCheck->num_rows == 0) {
 echo "<p style='color:red;'>User ID does not exists OR user has been blocked </p>";
 echo "<br>Click <a href='index.html'> here </a> to log-in again";
 }
 else
 {
 $row = $resultCheck->fetch_assoc();

 if( $row["UserPwd"] == $userPwd )
 {
	 
 session_start();

 $_SESSION["UID"] = $userID ;
 $_SESSION["UserType"] = $row["UserType"];

header("Location:menu.php");
 } else { 

 echo "<p style='color:red;'>Please Enter The Correct Password!</p>";
 echo "Click <a href='login.html'> here </a> to login again ";
 }
 }
}
$link->close();
?>