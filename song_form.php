<?php
session_start();

if(isset ($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset ="UTF-8">
<title> Gadis Melayu Songs Collection </title>
<style>
body {
    background-image:url("bg_gm.jpg");
    background-size: contain;
    background-position: center;
    height: 90vh;
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
</head>
<body>
<center>
<h1> <b style="color:#a86662;"> Song Registration Form </b></h1>
<h3> <b style="color:#ad8c84;">Enter song details </b></h3>

<p><i>field with <span style="color:#a86662;"> ♫ </span> is compulsory </i></p>

<form name="registerForm" action="song_register.php" method="POST">

<span style="color:#a86662;"> ♫ </span>
Song Title: <input type="text" name="Song_Title" maxlength="30" required> 
<br><br>
<span style="color:#a86662;"> ♫ </span>
Artist/Band Name: <input type="text" name="Artist_Name" maxlength="30" required>
<br><br>
<span style="color:#a86662;"> ♫ </span>
Song URL <i>(Audio/Video)</i>: <input type="link" name="Song_Media" required>
<br><br>
<span style="color:#a86662;"> ♫ </span>
Genre: <select name="Genre" required> 
<option value="" disabled selected > - Song Genres - </option>
<option value="Pop"> Pop Music </option>
<option value="Hiphop"> Hip-Hop </option>
<option value="Jazz"> Jazz </option>
<option value="RnB"> RnB </option>
<option value="Ballad"> Ballad </option>
</select>
<br><br>
<span style="color:#a86662;"> ♫ </span>
Language: <input type="radio" name="Language" value="Malay" checked> Malay
<input type="radio" name="Language" value="English" > English
<input type="radio" name="Language" value="Korean" > Korean
<input type="radio" name="Language" value="Indo" > Indo
<br><br>
<span style="color:#a86662;"> ♫ </span>
Release Date: <input type="date" name="Release_Date" required>
<br><br>
<input type="submit" value=" ▷ Display Song Details">
<input type="reset" value=" ↺ Cancel">
</form>
</center>
</body>
</html>
<?php
}
else 
{
	echo "No session exists of session has expired. Please log in again.<br>";
	echo"<a href='login.html'> Login </a>";
}
?>