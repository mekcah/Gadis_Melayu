<?php
session_start();
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
<center>
<title> Gadis Melayu Song Collection </title>
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
<h1> <b style="color:#a86662;"> Gadis Melayu Song Collection </b> </h1>
<p style="color:black;font-weight:bold;"> Song Update Save </p>
<?php
if (isset($_POST['Song_Id'])) {
$Song_Id = $_POST ['Song_Id'];
$Song_Title = $_POST ['Song_Title'];
$Artist_Name = $_POST ['Artist_Name'];
$Song_Media = $_POST ['Song_Media'];
$Genre = $_POST ['Genre'];
$Language = $_POST ['Language'];
$Release_Date = $_POST ['Release_Date'];


$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn= new mysqli ($host, $user, $pass, $db);

if ($conn->connect_error) {
 die ("Connection failed" . $conn->connect_error);
}
else
{
 $queryUpdate = "UPDATE SONG SET
    Song_Title = '".$Song_Title."' , Artist_Name = '".$Artist_Name."' ,  Song_Media = '".$Song_Media."',
	Genre = '".$Genre."' ,Language = '".$Language."', Release_Date = '".$Release_Date."'
    WHERE Song_Id = '".$Song_Id."' ";
	 
if ($conn->query($queryUpdate) === TRUE) {
 echo "Record has been updated into database.";
 echo "<br><br>";
 } else {
                echo "ERROR UPDATING RECORD: " . $conn->error;
            }
        }
        $conn->close();
    }
    echo "Click <a href='viewSong.php'>here</a> to view the song list.";
    ?>
</body>
</center>
</html>
<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>