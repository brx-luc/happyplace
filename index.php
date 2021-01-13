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
        <title>Happyplace</title>
    <style>
        iframe{
            border: none;
        }
        a{
            color: black;
            text-decoration: none;
        }
      
        body {
            font-family:Arial, Sans-Serif;
        }
        .clearfix:before, .clearfix:after{
            content: "";
            display: table;
        }
        .clearfix:after{
            clear: both;
        }
        a{
            color:#0067ab;
            text-decoration:none;
        }
        a:hover{
            text-decoration:underline;
        }
        .form{
            width: 300px;
            margin: 0 auto;
        }
        input[type='text'], input[type='email'],
        input[type='password'] {
            width: 200px;
            border-radius: 2px;
            border: 1px solid #CCC;
            padding: 10px;
            color: #333;
            font-size: 14px;
            margin-top: 10px;
        }
        input[type='submit']{
            padding: 10px 25px 8px;
            color: #fff;
            background-color: #0067ab;
            text-shadow: rgba(0,0,0,0.24) 0 1px 0;
            font-size: 16px;
            box-shadow: rgba(255,255,255,0.24) 0 2px 0 0 inset,#fff 0 1px 0 0;
            border: 1px solid #0164a5;
            border-radius: 2px;
            margin-top: 10px;
            cursor:pointer;
        }
        input[type='submit']:hover {
            background-color: #024978;
        }

    </style>
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
