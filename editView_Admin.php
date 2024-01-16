<?php
session_start();
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
<title> Gadis Melayu Songs Collection  </title>
</head>
<center>
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
    font-family: Arial, sans-serif;
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
	
input[type="submit"] {
    background-color: #a86662;
    color: white;
    border: none;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 10px 0;
    cursor: pointer;
    border-radius: 5px;
    }
</style>
<body>
<h2> <b style="color:#a86662;"> °。°。°。°。°。 Gadis Melayu Songs Collection 。°。°。°。°。° </b> </h2>
<p style="color:black;font-weight:bold;"> Song Update View </p>
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";
$conn = new mysqli ($host,$user,$pass,$db);

if ($conn->connect_error) {
("Connection failed" . $conn->connect_error);
}
else 
{
	$queryView = "SELECT * FROM SONG INNER JOIN USER ON SONG.User_Id = USER.UserID";
	$resultQ = $conn->query($queryView);
?>
<form action="editDetails_Admin.php" method="POST" onsubmit="return confirm('are you sure to edit this record?')">
<table border="2">
<tr>
<th> Choose </th>
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
    <td><input type="radio" name="Song_Id" value="<?php echo $row["Song_Id"]; ?>" required></td>
	<td> <?php echo $row["Song_Id"];?></td>
	<td> <?php echo $row["Song_Title"];?></td>
	<td> <?php echo $row["Artist_Name"];?></td>
	<td> Click  <a href="<?php echo $row["Song_Media"];?>" target="_blank">
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
	} elseif ($Status == "Rejected"){
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
<input type="submit" value="🔧View record to edit">
</form>
</center>
</body>
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