<?php
session_start();

if (isset($_SESSION["UID"])) {
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
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM SONG WHERE
					Song_Id LIKE ? OR
                    Song_Title LIKE ? OR
                    Artist_Name LIKE ? OR
					Song_Media LIKE ? OR
                    Genre LIKE ? OR
                    Language LIKE ? OR
                    Release_Date LIKE ? OR
					User_Id LIKE ? OR
					Status LIKE ?";

        $stmt = $conn->prepare($query);
        $keyword = "%" . $keyword . "%";
        $stmt->bind_param("sssssssss", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // No keyword provided, handle accordingly
        header("Location: SearchForm.php");
        exit();
    }
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

    // Display search results
    if ($result->num_rows > 0) {
        // Display the results in a table or any format you prefer
        while ($row = $result->fetch_assoc()) {
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
    } else {
        echo "No results found.";
    }
?>
</table>
<?php
    $stmt->close();
    $conn->close();
?>
<br>
<a href="Menu.php" class="menu-link">☰Menu</a>
</body>
</center>
</html>
<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>
