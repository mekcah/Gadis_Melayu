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
    background-image: url("bg_gm.jpg");
    background-size: contain;
    background-position: center;
    height: 80vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    }

h2 {
    color: #a86662;
    text-align: center;
	}
    
p {
    text-align: center;
    }

table {
    border-collapse: collapse;
    width: 100%;
    margin: 30px 0;
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

a.menu-link {    
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
<h2> <b style="color:#a86662;"> °。°。°。°。°。 Gadis Melayu Songs Collection  。°。°。°。°。° </b> </h2>
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
	$queryView = "SELECT * FROM SONG";
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
	<td>Click <a href="<?php echo $row["Song_Media"]; ?>" target="_blank"><img
    src="play.jpg" alt="play" width="20" height="20"></a> to Listen</td>
	</td>
	<td> <?php echo $row["Genre"];?></td>
	<td> <?php echo $row["Language"];?></td>
	<td> <?php echo $row["Release_Date"];?></td>
	<td> <?php echo $row["User_Id"];?></td>
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
<br>
<a href="Menu.php" class="menu-link">☰Menu</a>
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
