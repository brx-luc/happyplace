<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
 $con = new mysqli('localhost','root','','happyplace');
 // Check connection
 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['email'])){
        // removes backslashes
 $email = stripslashes($_REQUEST['email']);
        //escapes special characters in a string
 $email = mysqli_real_escape_string($con,$email);
 $password = $_REQUEST['passwort'];
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
$query = "SELECT * FROM `tbl_users` WHERE email='$email'
and passwort='$password'";
 $result = mysqli_query($con,$query) or die(mysql_error());
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