<?php
session_start();

if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<center>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gadis Melayu Songs Collection</title>
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
		
.edit-link {
	padding: 5px 10px;
	background-color: #a86662; 
    color: #fff;
	border-radius: 5px;
    color: white;
	text-decoration: none;
	display: inline-block;
    }

.menu-link {
	padding: 5px 10px;
	background-color: #a86662; 
    color: #fff;
	border-radius: 5px;
    color: white;
	text-decoration: none;
	
}
</style>
</head>
<body>
<h2>Gadis Melayu Songs Collection</h2>
<p style="color: black; font-weight: bold;">Update User Status</p>

<?php
$User_Id = $_SESSION["UID"];
$host = "localhost";
$user = "root";
$pass = "";
$db = "gadismelayu_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
    } else {
    $queryView = "SELECT * FROM USER WHERE UserType = 'user'";
    $resultQ = $conn->query($queryView);
    ?>
<table>
<tr>
<th>User ID</th>
<th>User Status</th>
</tr>

<?php
    if ($resultQ->num_rows > 0) {
        while ($row = $resultQ->fetch_assoc()) {
            ?>

<tr>
<td><?php echo $row["UserID"]; ?></td>
<td><?php echo $row["User_Status"]; ?></td>
</tr>
<?php
    }
    } else {
        echo "<tr><td colspan='2'>NO DATA SELECTED</td></tr>";
        }
?>
</table>

<?php
    $conn->close();
    }
    ?>
<br>
Click <a href="editUser_Admin.php" class = "edit-link">here</a>to EDIT User Status.
<br><br>
<a href="menu.php" class = "menu-link">☰Menu</a>
<br><br>
</body>
</center>
</html>
<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>
