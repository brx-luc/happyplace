<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once("../database.class.php");
    $con = new Database("localhost", "root", "", "happyplace");
    
    // Prepare a select statement
    $sql = "SELECT l.id, l.Vorname, l.Nachname, o.PLZ, o.Ortname FROM tbl_lernende l
    join tbl_orte o on o.id = l.fk_o
    WHERE l.id = ?;";
    
    if($stmt = $con->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param( "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $vorname = $row["Vorname"];
                $nachname = $row["Nachname"];
                $plz = $row["PLZ"];
                $ortname = $row["Ortname"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $con->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lernende</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Lernende</h1>
                    </div>
                    <div class="form-group">
                        <label>Vorname</label>
                        <p class="form-control-static"><?php echo $row["Vorname"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nachname</label>
                        <p class="form-control-static"><?php echo $row["Nachname"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Postleizahl</label>
                        <p class="form-control-static"><?php echo $row["PLZ"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ortname</label>
                        <p class="form-control-static"><?php echo $row["Ortname"]; ?></p>
                    </div>
                    <p><a href="dashboard.php" class="btn btn-primary">Zurück zur Startseite</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>