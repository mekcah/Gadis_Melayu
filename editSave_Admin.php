<?php
session_start();
if (isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
<center>
<title>Gadis Melayu Song Collection</title>
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
</head>
<h1><b style="color:#a86662;">Gadis Melayu Song Collection</b></h1>
<p style="color:black;font-weight:bold;">Song Update Save</p>
<?php
if (isset($_POST['Song_Id'])) {
$Song_Id = $_POST['Song_Id'];
$Status = $_POST['Status'];

$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
 die("Connection failed" . $conn->connect_error);
} else {
$queryUpdateSong = "UPDATE SONG SET
    Status = '" . $Status . "'
    WHERE Song_Id = '" . $Song_Id . "' ";

if ($conn->query($queryUpdateSong) === TRUE) {
    echo "Record has been updated into the database.";
    echo "<br><br>";
    } else {
    echo "ERROR UPDATING RECORD: " . $conn->error;
            }
        }
        $conn->close();
    }
    echo "Click <a href='viewSong_Admin.php'>here</a> to view the song list.";
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
