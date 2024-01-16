<?php
session_start();
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html>
<head>
<center>
<title> Gadis Melayu Song Collection </title>
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
    padding: 5px 8px; 
    background-color: #a86662; 
    color: #fff; 
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

</style>
</head>

<body>
<h1> <b style="color:#a86662;"> Gadis Melayu Song Collection </b> </h1>

<?php
$Song_Id = $_POST["Song_Id"];
?>
<?php
$host="localhost";
$user="root";
$pass="";
$db="gadismelayu_db";

$conn= new mysqli ($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $deleteQuery="DELETE FROM SONG WHERE Song_Id = '".$Song_Id."' ";

    if($conn->query($deleteQuery) === TRUE) {
        echo "<p style='color:purple;'> Record has been deleted from the database!</p>";
        echo "Click <a href='viewSong.php'>here</a> to view the song list.";
    } else {
        echo "<p style='color:red;'>Query problems: " . $conn->error . "</p>";
    }
    $conn->close();
}
?>
</body>
</center>
</html>
<?php
}
else
{
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
