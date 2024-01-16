<?php
session_start();
if (isset($_SESSION["UID"])) {
    session_unset();
    session_destroy();
    $logoutMessage = "You have successfully logged out.";
} else {
    $logoutMessage = "No session exists or the session has expired. Please log in again.";
}
?>

<center>
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

p {
    color: red;
    text-align: center;
}

a {
    background-color: #a86662;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
    padding: 5px 8px;
    margin-top: 10px;
}
</style>

<?php
echo "<p>{$logoutMessage}</p>";
echo "<a href='index.html'>Click here to log in again.</a>";
?>

</center>
