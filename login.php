<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
require_once("database.class.php");
$con = new Database("localhost", "root", "", "happyplace");
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['email']) && isset($_POST['passwort'])){
        // removes backslashes
 $email = stripslashes($_REQUEST['email']);
        //escapes special characters in a string
 $email = $con->escape($email);
 $password = $_REQUEST['passwort'];
 $password =$con->escape($password);
 //Checking is user existing in the database or not
$query = "SELECT * FROM `tbl_users` WHERE email='$email'
and passwort='$password'";
 $result = $con->query($query);
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION['email'] = $email/*&& $_SESSION['passwort'] = $password*/;
            // Redirect user to register.php
     header("Location: crud/dashboard.php");
         }else{
 echo "<div class='form'>
<h3>Email/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
 }
    }else{
?>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login">
<input type="text" name="email" placeholder="Email" required />
<input type="password" name="passwort" placeholder="Passwort" required />
<input name="submit" type="submit" value="Login" />
</form>
</div>
<?php } ?>
</body>
</html>