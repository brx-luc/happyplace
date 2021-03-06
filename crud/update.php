<?php
// Include config file
require_once("../database.class.php");
$con = new Database("localhost", "root", "", "happyplace");
// Define variables and initialize with empty values
$id = 0;
$vorname = $nachname = $plz = $ortname = "";
$vorname_err = $nachname_err = $plz_err = $ortname_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_vorname = trim($_POST["vorname"]);
    if(empty($input_vorname)){
        $vorname_err = "Bitte geben Sie einen Namen ein.";
    } elseif(!filter_var($input_vorname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $vorname_err = "Bitte geben Sie einen Namen ein.";
    } else{
        $vorname = $input_vorname;
    }

    $input_name = trim($_POST["nachname"]);
    if(empty($input_name)){
        $nachname_err = "Bitte geben Sie einen Namen ein.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nachname_err = "Bitte geben Sie einen Namen ein.";
    } else{
        $nachname = $input_name;
    }
    
    $input_plz = trim($_POST["PLZ"]);
    if(empty($input_plz)){
        $plz_err = "Bitte geben Sie eine Postleizahl ein.";     
    } else{
        $plz = $input_plz;
    }
    
    $input_ortname = trim($_POST["Ortname"]);
    if(empty($input_ortname)){
        $ortname_err = "Bitte geben Sie einen Ortnamen ein.";     
    } else{
        $ortname = $input_ortname;
    }
    
    // Check input errors before inserting in database
    if(empty($vorname_err) && empty($nachname_err) && empty($plz_err) && empty($ortname_err)){
        
        $sql = "DELETE l, o from tbl_lernende l
        INNER Join tbl_orte o on o.id = l.fk_o
        WHERE l.id = ?;";
    
        if($stmt = $con->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("issssi", $param_id, $param_plz, $param_ortname, $param_vorname, $param_nachname, $param_fk);
            
            // Set parameters
            $param_id = $id;
            $param_plz = $plz;
            $param_ortname = $ortname;
            $param_vorname = $vorname;
            $param_nachname = $nachname;
            $param_fk = $con->id();
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: dashboard.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
          } else {
              echo "Something's wrong with the query: " . $con->connect_error;
          }
        }
         
        if($stmt = $con->prepare($sql)){
          // Bind variables to the prepared statement as parameters
          $stmt->bind_param("ssi", $param_vorname, $param_nachname, $param_id);
          
          // Set parameters
          $param_vorname = $vorname;
          $param_nachname = $nachname;
          $param_id = $demande;
          
          // Attempt to execute the prepared statement
          if($stmt->execute()){
              // Records updated successfully. Redirect to landing page
              header("location: dashboard.php");
              exit();
          } else{
              echo "Something went wrong. Please try again later.";
          }
          $stmt->close();
        } else {
            echo "Something's wrong with the query: " . $con->connect_error;
        }
      
        // Close statement
    
    // Close connection
    $con->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT l.id, l.Vorname, l.Nachname, o.PLZ, o.Ortname FROM tbl_lernende l
        join tbl_orte o on o.id = l.fk_o
        WHERE l.id = ?;";
        if($stmt = $con->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $vorname = $row["Vorname"];
                    $nachname = $row["Nachname"];
                    $plz = $row["PLZ"];
                    $ortname = $row["Ortname"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
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
                        <h2>Update</h2>
                    </div>
                    <p>Bitte neue Daten einfügen, um die Tabelle zu aktualisieren.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($vorname_err)) ? 'has-error' : ''; ?>">
                            <label>Vorname</label>
                            <input type="text" name="vorname" class="form-control" value="<?php echo $vorname; ?>">
                            <span class="help-block"><?php echo $vorname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($nachname_err)) ? 'has-error' : ''; ?>">
                            <label>Nachname</label>
                            <input type="text" name="nachname" class="form-control" value="<?php echo $nachname; ?>">
                            <span class="help-block"><?php echo $nachname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($plz_err)) ? 'has-error' : ''; ?>">
                            <label>Postleizahl</label>
                            <input type="text" name="PLZ" class="form-control" value="<?php echo $plz; ?>">
                            <span class="help-block"><?php echo $plz_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ortname_err)) ? 'has-error' : ''; ?>">
                            <label>Ortname</label>
                            <input type="text" name="Ortname" class="form-control" value="<?php echo $ortname; ?>">
                            <span class="help-block"><?php echo $ortname_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="dashboard.php" class="btn btn-default">Abbrechen</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>