<?php
session_start();

if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
<title>Gadis Melayu Songs Collection</title>
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
    }

h2 {
    color: #a86662;
    }

table {
    border-collapse: collapse;
    width: 100%;
    margin: 20px 0;
    }

th, td {
    border: 1px solid #a86662;
    padding: 10px;
    }

th {
    background-color: #a86662;
    color: white;
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
<h2><b style="color:#a86662;">Gadis Melayu Songs Collection</b></h2>
<p style="color:black;font-weight:bold;">Update User Status</p>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}
else {
$queryView = "SELECT * FROM USER WHERE UserType = 'user'";
$resultQ = $conn->query($queryView);
?>
<form action="editUserStatus_Admin.php" method="POST" onsubmit="return confirm('Are you sure to edit this record')">
<table border="1">
<tr>
<th>Choose</th>
<th>User ID</th>
<th>User Status</th>
</tr>

<?php
if ($resultQ->num_rows > 0) {
while ($row = $resultQ->fetch_assoc()) {
?>
<tr>
<td><input type="radio" name="UserID" value="<?php echo $row["UserID"]; ?>" required></td>
<td><?php echo $row["UserID"]; ?></td>
<td><?php echo $row["User_Status"]; ?></td>
</tr>
<?php
}
} else {
echo '<tr><td colspan="3" style="color: red;">NO DATA SELECTED</td></tr>';
}
?>
</table>
<br><br>
<input type="submit" value="💾Update New Details">
</form>

<?php
    $conn->close();
}
?>
</body>
</center>
</html>
<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>
