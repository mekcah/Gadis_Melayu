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
</head>
<body>
<h1> 
    <h2>°。°。°。°。°。 Gadis Melayu Songs Collection  。°。°。°。°。°</h2>
    <p style="font-weight:bold;">Song Delete View</p>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn = new mysqli ($host, $user, $pass, $db);

if ($conn->connect_error) {
	die ("Connection failed" . $conn->connect_error);
} 
else {
	$queryView = "SELECT * FROM SONG where User_Id = '".$_SESSION ["UID"]."' ";
	$resultQ = $conn->query($queryView);

?>

<form action="song_delete.php" method="POST" onsubmit="return confirm('Are you sure to delete this record?')">

<table border="2">
<tr>
<th> Choose </th>
<th> Song ID</th>
<th> Song Title</th>
<th> Artist/Band Name</th>
<th> Genre</th>
<th> Language</th>
<th> Release Date</th>
<th> Song URL</th>
<th> Status</th>
</tr>

<?php
if ($resultQ->num_rows > 0) {
	while($row = $resultQ->fetch_assoc()) {
?>
<tr>
<td><input type="radio" name="Song_Id" value="<?php echo $row["Song_Id"]; ?>" required></td>

<td><?php echo $row ["Song_Id"]; ?></td>
<td><?php echo $row ["Song_Title"]; ?></td>	
<td><?php echo $row ["Artist_Name"]; ?></td>	
<td><?php echo $row ["Genre"]; ?></td>	
<td><?php echo $row ["Language"]; ?></td> 
<td><?php echo $row ["Release_Date"];?></td>
<td>Click <a href="<?php echo $row["Song_Media"]; ?>" target="_blank"><img
src="play.jpg" alt="play" width="20" height="20"></a> to Listen</td>

</td>
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
    } else {
    echo "<tr><td colspan='8'> NO data selected </td></tr>";
}
}
?>
</table>
<?php 
$conn->close();
?>
<br>
<input type="submit" value="🗑️Delete Selected Record">
</form>
<br>
<br>
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