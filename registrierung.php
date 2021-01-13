<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="./css/style.css" />
<style>
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