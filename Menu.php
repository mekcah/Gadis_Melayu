<?php
session_start();

if (isset($_SESSION["UID"])) {
?>
<html>
<head>
<title> Gadis Melayu Songs Collection </title>
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

.container {
    border-radius: 15px;
    text-align: center;
    }

h2 {
    color: #a86662;
    font-size: 28px;
    margin-bottom: 15px;
    }

p {
    font-size: 18px;
    margin-bottom: 20px;
    }

.menu-link {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background-color: #e8b2ae;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    }

.menu-link img {
    vertical-align: middle;
    margin-right: 5px;
    }
    </style>
</head>

<body>
<div class="container">
<h2> <b> WELCOME, HI <?php echo $_SESSION["UID"]; ?> </b></h2>
<p> <i> Choose your menu </i> </p>

<?php
if ($_SESSION["UserType"] == "Admin") {
    ?>
<a href="viewSong_Admin.php" class="menu-link">
🗒️Song List
</a>
<a href="UserList.php" class="menu-link">
🗒️User List
</a>
<?php
    } else {
    ?>
<a href="song_form.php" class="menu-link"> 🧑🏻‍💻Register New Song </a>
<a href="song_editView.php" class="menu-link"> 🔧Edit Song Details </a>
<a href="song_deleteView.php" class="menu-link"> 🗑️Delete Song Record </a>
<a href="viewSong.php" class="menu-link"> 🗒️View Song List </a>
<?php
    }
?>
<a href="logout.php" class="menu-link">
🔐Logout
</a>
</div>
</body>

</html>
<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'> Login </a>";
}
?>
