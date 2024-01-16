<?php
session_start();
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
<center>
<title> Gadis Melayu Songs Collection </title>
</head>
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

form {
    background-color:white;
    padding: 20px;
    border-radius: 26px;
    text-align: center;
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
	
input[type="text"],
input[type="text"],
input[type ="link"],
input[type ="date"] {
    padding: 8px;
    margin: 3px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    width: 40%;
    font-size: 14px;
    }
	
input[type="submit"],
input[type="reset"] {
    background-color:#a86662;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
    }   
</style>
<body>
<h2> <b style="color:#a86662;"> Gadis Melayu Songs Collection </b> </h2>
<p style="color:black;font-weight:bold;"> Update Song Details </p>

<?php
$Song_Id = $_POST["Song_Id"];

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
$queryView = "SELECT * FROM SONG WHERE Song_Id = $Song_Id"; 
$resultQ = $conn->query($queryView);
    
if ($resultQ->num_rows > 0){
?>
<form action="editSave_Admin.php" name="UpdateForm" method="POST">
<input type="hidden" name="Song_Id" value="<?php echo $Song_Id; ?>">
<table border="1"
<?php
while ($row=$resultQ->fetch_assoc()){
$Status = $row["Status"];
?>
<tr><td>Song Id: </td><td><?php echo $row["Song_Id"]; ?></td></tr>
<tr><td>Song Title: </td><td><?php echo $row["Song_Title"]; ?></td></tr>
<tr><td>Artist Name:</td><td> <?php echo $row["Artist_Name"]; ?></td></tr>
<tr><td>Song Media:</td><td> Click <a href="<?php echo $row["Song_Media"];?>" target="_blank">
<img src="play.jpg" alt="play" style="max-width: 20px; max-height: 20px;">
</a>To Listen
</td>
<tr><td>Song Genre:</td><td><?php echo $row["Genre"]; ?></td></tr>
<tr><td>Language:</td><td><?php echo $row["Language"]; ?></td></tr>
<tr><td>Release Date:</td><td><?php echo $row["Release_Date"]; ?></td></tr>
<tr><td>User ID:</td><td><?php echo $row["User_Id"]; ?></td></tr>
<tr><td>Status:</td><td> 
<input type="radio" name="Status" value="Approved" <?php if ($Status == "Approved") echo "checked"; ?>> Approved
<input type="radio" name="Status" value="Rejected" <?php if ($Status == "Rejected") echo "checked"; ?>> Rejected
</td></tr>
<?php
}
?>
</table>
<br><br>

<input type="submit" value="💾Update New Details">
</form> 
<?php
$conn->close();
}
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
