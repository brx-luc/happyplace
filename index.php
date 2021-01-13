<?php
    $con = new mysqli('localhost','root','','happyplace');
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="../css/style.css" rel="stylesheet">
        <title>Happyplace</title>
    </head>
    <body>
    <h1>Project Happy place</h1>
    <p><a href="login.php">Adminlogin</a></p>
    <p><a href="registrierung.php">Registrieren</a></p>
    <iframe src="karte.php" width="2000px" height="1000px" scrolling="no"></iframe>
    <?php
    //phpinfo();
    require_once 'register.php';
    ?>
    </body>
</html>
