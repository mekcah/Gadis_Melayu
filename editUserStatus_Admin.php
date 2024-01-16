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
	
input[type="submit"] {
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
<h2> <b style="color:#a86662;"> Gadis Melayu Songs Collection </b> </h2>
<p style="color:black;font-weight:bold;"> Update Song Details </p>

<?php
$User_Id = $_POST["UserID"];

$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

$queryGet = "SELECT * FROM USER WHERE UserID = '$User_Id'";
$resultGet = $conn->query($queryGet);

if ($resultGet === false) {
echo "Error executing query: " . $conn->error;
} elseif ($resultGet->num_rows > 0) {
?>
<form action="editUserSave_Admin.php" method="POST">
<?php while ($row = $resultGet->fetch_assoc()): ?>
<?php
$User_Status = $row["User_Status"];
?>
User ID: <?php echo $row["UserID"]; ?><br><br>
User Status: <?php $User_Status = $row["User_Status"]; ?>
<input type="radio" name="User_Status" value="Active" <?php echo ($User_Status == "Active") ? "checked" : ""; ?>> Active
<input type="radio" name="User_Status" value="Blocked" <?php echo ($User_Status == "Blocked") ? "checked" : ""; ?>> Blocked
<br><br>
<input type="hidden" name="UserID" value="<?php echo $row['UserID'] ?>">
<input type="submit" value="💾Update New Details">
<br><br>
<?php endwhile; ?>
</form>
<?php
} else {
    echo "No data found for UserID: $User_Id";
}

$conn->close();
?>
</body>
</html>
<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>