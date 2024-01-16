<?php
session_start();
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html>
<head>
<title> Gadis Melayu Songs Collection </title>
</head>
<center>
<body>
<style>
body {
	background-image:url("bg_gm.jpg");
    background-size: contain;
    background-position: center;
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin: 10px 0;
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

input[type="radio"] {
    margin-left: 5px;
    }
	
.edit-link {
	padding: 5px 10px;
	background-color: #a86662; 
    color: #fff;
	border-radius: 5px;
    text-color: white; 
	text-decoration: none;
	 display: inline-block;
}

.menu-link {
	padding: 5px 10px;
	background-color: #a86662; 
    color: #fff;
	border-radius: 5px;
    text-color: white;
	text-decoration: none;
}
</style>
<h2> <b style="color:#a86662;">°。°。°。°。°。 Gadis Melayu Songs Collection  。°。°。°。°。° </b> </h2>
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";
$conn = new mysqli ($host,$user,$pass,$db);

if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}
else 
{
	$queryView = "SELECT SONG.*, USER.User_Status FROM SONG INNER JOIN USER ON SONG.User_Id = USER.UserID";

	$resultQ = $conn->query($queryView);
	
?>
<table border="2">
<tr>
<th> Song ID </th>
<th> Song Title </th>
<th> Artist Name </th>
<th> Song Media </th>
<th> Genre </th>
<th> Language </th>
<th> Release Date </th>
<th> User ID </th>
<th> User Status </th>
<th> Status </th>
</tr>
<?php 
if ($resultQ->num_rows > 0){
	while($row = $resultQ->fetch_assoc()) {
?>
<tr>
	<td> <?php echo $row["Song_Id"];?></td>
	<td> <?php echo $row["Song_Title"];?></td>
	<td> <?php echo $row["Artist_Name"];?></td>
	<td> Click <a href="<?php echo $row["Song_Media"];?>" target="_blank">
    <img src="play.jpg" alt="play" style="max-width: 20px; max-height: 20px;">
    </a>To Listen
	</td>
	<td> <?php echo $row["Genre"];?></td>
	<td> <?php echo $row["Language"];?></td>
	<td> <?php echo $row["Release_Date"];?></td>
	<td> <?php echo $row["User_Id"];?></td>
	<td> <?php echo $row["User_Status"];?></td>
	<td> <?php $Status = $row["Status"]; 
	if ($Status == "Approved"){
		echo "Approved";
	} else if ($Status == "Rejected"){
		echo "Rejected";
	} else {
	    echo "Pending";
	}
	?> </td>
	
</tr>
<?php
	}
}else {
	echo "<tr><td colspan='8'> NO Data Selected </td></tr>";
}
}
?>
</table>
<?php
$conn->close();
?>
<br><br>
<a href="editView_Admin.php"class="edit-link">🔧Edit</a>
<br><br>
<a href="Menu.php"class="menu-link">☰Menu</a>
</body>
</center>
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