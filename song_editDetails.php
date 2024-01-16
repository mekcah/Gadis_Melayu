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
	
input[type="text"],
input[type="text"],
input[type ="link"],
input[type ="date"]
 {
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
<h3> <p style="color:#ad8c84;font-weight:bold;"> Update Song Details </p> </h3>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$host="localhost";
$user="root";
$pass="";
$db="gadismelayu_db";

$conn = new mysqli ($host,$user,$pass,$db);

if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}
	$Song_Id=$_POST["Song_Id"];
	$queryUpdate = "SELECT * FROM SONG WHERE Song_Id = $Song_Id AND User_Id = '".$_SESSION["UID"]."'";
	$resultUpdate = $conn->query($queryUpdate);
	
	if ($resultUpdate->num_rows > 0){
		$row = $resultUpdate->fetch_assoc();
        $Status = $row["Status"];
?>
<form action="song_editSave.php" name="UpdateForm" method="POST">
<input type="hidden" name="Song_Id" value="<?php echo $row["Song_Id"]; ?>">
Song Title: <input type="text" name="Song_Title" value=" <?php echo $row ['Song_Title']; ?>" maxlength="30" size="35" required>
<br><br>
Artist/Band Name: <input type = "text" name = "Artist_Name" value = " <?php echo $row ['Artist_Name']; ?>" maxlength="20" size="35" required>
<br><br>
Genre: 
<?php $Genre = $row ['Genre']; ?>
<select name = "Genre" required>
   <option value=""> - Song Genres - </option>
   <option value="Pop" <?php if ($Genre == "Pop") echo "selected"; ?>> Pop Music </option>
   <option value="Hiphop" <?php if ($Genre == "Hiphop") echo "selected"; ?>> Hip-Hop </option>
   <option value="Jazz" <?php if ($Genre == "Jazz") echo "selected"; ?>> Jazz </option>
   <option value="RnB" <?php if ($Genre == "RnB") echo "selected"; ?>> RnB </option>
   <option value="Ballad" <?php if ($Genre == "Ballad") echo "selected"; ?>> Ballad </option>
</select>
<br><br>
Language: <?php $Language = $row ["Language"]; ?>
<input type="radio" name="Language" value="Malay" <?php if ($Language == "Malay") 
echo "checked"; ?>> Malay
<input type="radio" name="Language" value="English" <?php if ($Language == "English") 
echo "checked"; ?>> English
<input type="radio" name="Language" value="Korean" <?php if ($Language == "Korean") 
echo "checked"; ?>> Korean
<input type="radio" name="Language" value="Indo" <?php if ($Language == "Indo") 
echo "checked"; ?>> Indo
<br><br>
Release Date: <input type="date" name="Release_Date" value="<?php echo $row ["Release_Date"]; ?>" required>
<br><br>
Song URL: <a style="color:blue;"><input type="link" name="Song_Media" value="<?php echo $row ["Song_Media"]; ?>" maxlength="30" size="35" required>
<br><br>
<input type = "submit" value = "💾Update New Details">
</form>

<?php
	}
}
$conn->close();
?>
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