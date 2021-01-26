<?php
// Include config file

require_once("../database.class.php");
$con = new Database("localhost", "root", "", "happyplace");
    
// Define variables and initialize with empty values
$vorname = $nachname = $plz = $ortname = "";
$vorname_err = $nachname_err = $plz_err = $ortname_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    
    $input_ortname = trim($_POST["ortname"]);
    if(empty($input_ortname)){
        $salary_err = "Bitte geben Sie einen Ortnamen ein.";     
    } else{
        $ortname = $input_ortname;
    }
    
    // Check input errors before inserting in database
    if(empty($vorname_err) && empty($nachname_err) && empty($plz_err) && empty($ortname_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_orte (PLZ, Ortname)
        VALUES (?, ?);";
        printf("New id %d", $con->id());
        $demande = $con->id();
        $sql = "INSERT Into tbl_lernende (Vorname, Nachname,fk_o, fk_m)
        VALUES (?, ?,$demande, 3);";
        

        if($stmt = $con->prepare($sql)){
            // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $param_plz, $param_ortname /*,$param_vorname, $param_nachname, $param_demande, $param_fk*/ );
            // Set parameters
            $param_plz = $plz;
            $param_ortname = $ortname;
            /*$param_vorname = $vorname;
            $param_nachname = $nachname;
            $param_demande = $demande;
            $param_fk = 3;*/
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                header("location: dashboard.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
          } else {
              printf("Something's wrong with the query: %s",$con->connect_error);
        }
    }
    $con->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Neuen Lernenden hinzufügen</h2>
                    </div>
                    <p>Bitte Formular ausfüllen und abschicken, um neuen Lernenden hinzuzufügen.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <input type ="text" name="PLZ" class="form-control"><?php echo $plz; ?></textarea>
                            <span class="help-block"><?php echo $plz_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ortname_err)) ? 'has-error' : ''; ?>">
                            <label>Ortname</label>
                            <input type="text" name="ortname" class="form-control" value="<?php echo $ortname; ?>">
                            <span class="help-block"><?php echo $ortname_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="dashboard.php" class="btn btn-default">Abbrechen</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>