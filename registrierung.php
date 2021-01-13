<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
$con = mysqli_connect('localhost','root','','happyplace');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// If form submitted, insert values into the database.
$con;
if (isset($_REQUEST['email'])){
        // removes backslashes
        //escapes special characters in a string
 $email = stripslashes($_REQUEST['email']);
 $email = mysqli_real_escape_string($con,$email);
 $password = stripslashes($_REQUEST['passwort']);
 $password = mysqli_real_escape_string($con,$password);
 $query = "INSERT into tbl_users (passwort, email)
VALUES ('$password', '$email');";
        $result = mysqli_query($con,$query);
     if($result){
          echo "<div class='form'>
          <h3>You are registered successfully.</h3>
          <br/>Click here to <a href='login.php'>Login</a></div>";
               }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="passwort" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php } ?>
</body>
</html>