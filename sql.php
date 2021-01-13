<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css">
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
 $con = new mysqli('localhost','root','','happyplace');
 // Check connection
 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['vorname'])){
        // removes backslashes
 $vorname = stripslashes($_REQUEST['vorname']);
        //escapes special characters in a string
 $vorname = mysqli_real_escape_string($con,$vorname);
 $nachname = $_REQUEST['nachname'];
 $nachname = mysqli_real_escape_string($con,$nachname);
 $plz = $_REQUEST['PLZ'];
 $plz = mysqli_real_escape_string($con,$plz);
 $ortname = $_REQUEST['ortname'];
 $ortname = mysqli_real_escape_string($con,$ortname);
 //Checking is user existing in the database or not
$query = "INSERT into `tbl_lernende` (vorname,nachname,PLZ,ortname VALUES ('$vorname', '$nachname', '$plz', '$ortname');";
 $result = mysqli_query($con,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
}
?>
<div class="form">
<h1>Create</h1>
<form action="" method="post" name="login">
<input type="text" name="vorname" placeholder="Vorname" required />
<input type="text" name="nachname" placeholder="Nachname" required />
<input type="text" name="PLZ" placeholder="Postleizahl" required />
<input type="text" name="ortname" placeholder="Ortname" required />
<input name="submit" type="submit" value="Create" />
</form>
</div>

</body>
</html>