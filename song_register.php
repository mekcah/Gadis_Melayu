<?php
session_start();
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html>
<head>
<center>
<meta charset="UTF-8">
<title> Gadis Melayu Songs Collection</title>

<?php
$Song_Title = $_POST ["Song_Title"];
$Artist_Name = $_POST ["Artist_Name"];
$Song_Media = $_POST ["Song_Media"];
$Genre = $_POST ["Genre"];
$Language = $_POST ["Language"];
$Release_Date = $_POST ["Release_Date"];

if (isset($_POST["User_Id"])) {
    $User_Id = $_POST["User_Id"];
} else {
   
    $User_Id = $_SESSION["UID"]; 
}

if (isset($_POST["Status"])) {
    $Status = $_POST["Status"];
} else {
    $Status = "";
}

?>

<body>
<style>
body {
    background-image: url("bg_gm.jpg");
    background-size: contain;
    background-position: center;
    height: 80vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

table {
    border-collapse:collapse;
    width: 80%; 
	background-color: white;
    padding: 30px;
    border-radius: 20px;
    text-align: center;
}

th, td {
    border: 2px solid #a86662;
    padding: 10px; 
    text-align: left;
}

th {
    background-color: #a86662;
    color: white;
}

.song-link {
	padding: 5px 10px;
	background-color: #a86662; 
    color: #fff;
	border-radius: 5px;
    color: white;
	text-decoration: none;
	display: inline-block;
}

.view-link {
	padding: 5px 10px;
	background-color: #a86662; 
    color: #fff;
	border-radius: 5px;
    color: white;
	text-decoration: none;
} 
</style>

<h1> <b style="color:#a86662;"> Song Registration Details </b> </h1>

<table border="2">
<tr>
<td> Song Title: </td><td><b style="color:purple;"> <?php echo $Song_Title; ?></b></td>
</tr>
<tr>
<td> Artist/Band Name: </td><td><b> <?php echo $Artist_Name; ?></b></td>
</tr> 
<tr>
<td> Audio/Video of Song: </td><td><b><a style="color:blue;"> <?php echo $Song_Media; ?></b></td>
</tr> 
<tr>
<td> Genre: </td><td><b><?php echo $Genre; ?></b></td>
</tr> 
<tr>
<td> Language: </td><td><b> <?php echo $Language; ?></b></td>
</tr> 
<tr>
<td> Release Date: </td><td><b> <?php echo $Release_Date; ?> </b></td>
</tr> 
</table> 
<br>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn = new mysqli ($host, $user, $pass, $db);

if ($conn->connect_error) {
 die("Connection failed" . $conn->connect_error);
}

else {
 $DBquery = "insert into SONG (Song_Title, Artist_Name, Song_Media, Genre, Language, Release_Date, User_Id, Status) 
 VALUES('".$Song_Title."','".$Artist_Name."','".$Song_Media."','".$Genre."','".$Language."','".$Release_Date."','".$_SESSION["UID"]."', '".$Status."')";
 
 if ($conn->query($DBquery) === TRUE) {
  echo "<p style = 'color:blue;'> Success insert Song data</p>";
 } else {
  echo "<p style = 'color:red;'> Error: Invalid query " . $conn-> error." </p>";
 }
}
$conn->close();
?>

<a href ="song_form.php"class ="song-link"> 💻Enter new song details </a>
<br><br>
<a href="viewSong.php"class ="view-link"> 🗒View ALL Songs </a> 
</body>
</center>
</head>
</html>
<?php
}
else
{
echo "No session exists or session has expired. Please
log in again.<br>";
echo "<a href=login.html> Login </a>";
}
?>