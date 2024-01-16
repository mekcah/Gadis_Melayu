<?php
session_start();
if (isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
<center>
<title>Gadis Melayu Song Collection</title>
</head>
<body>
<style>
body {
    background-image:url("bg_gm.jpg");
    background-size: contain;
    background-position: center;
    height: 80vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    }
	

a {
    background-color: #a86662;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
    padding: 5px 8px;
    margin-top: 10px;
}
</style>
<h3><b style="color:#a86662;">Gadis Melayu Song Collection</b></h3>
<p style="color:black;font-weight:bold;">Update User Status</p>

<?php
if (isset($_POST['UserID']) && isset($_POST['User_Status'])) {
$User_Id = $_POST['UserID'];
$User_Status = $_POST['User_Status'];

$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
   die("Connection failed" . $conn->connect_error);
} else {
$queryUpdateSong = "UPDATE USER SET User_Status = '$User_Status' WHERE UserID = '$User_Id' ";

if ($conn->query($queryUpdateSong) === TRUE) {
echo "Record has been updated into the database.";
echo "<br><br>
Click <a href='UserList.php'>here</a> to VIEW User List.";
} else {
echo "ERROR UPDATING RECORD: " . $conn->error;
}
$conn->close();
}
} else {
  echo "No User_Status provided.";
}
?>
</body>
</center>
</html>
<?php
}else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>
