<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombre = $especie = $raza = $edad = $img = "";
$nombre_err = $especie_err = $raza_err = $edad_err = $img_err ="";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validar nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $name_err = "Por favor introduce un nombre";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Por favor introduce un nombre";
    } else{
        $nombre = $input_nombre;
    }
    
    // Validar especie
    $input_especie = trim($_POST["especie"]);
    if(empty($input_especie)){
        $especie_err = "Por favor introduce una especie";  
    } else{
        $especie = $input_especie;
    }

    // Validar raza
    $input_raza = trim($_POST["raza"]);
    if(empty($input_raza)){
        $raza_err = "Por favor introduce la raza";     
    } else{
        $raza = $input_raza;
    }
    
    // Validar edad
    $input_edad = trim($_POST["edad"]);
    if(empty($input_edad)){
        $edad_err = "Por favor introduce edad";     
    } elseif(!ctype_digit($input_edad)){
        $edad_err = "Por favor introduce un número entero";
    } else{
        $edad = $input_edad;
    }

    // Validar img
    $input_img = trim($_POST["img"]);
    if(empty($input_img)){
        $img_err = "Por favor introduce una imagen";     
    } else{
        $img = $input_img;
    }
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($especie_err) && empty($raza_err) && empty($edad_err) && empty($img_err)){
        // Prepare an update statement
        $sql = "UPDATE animales SET nombre=?, especie=?, raza=?, edad=?, img=? WHERE id=?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssi", $param_nombre, $param_especie, $param_raza, $param_edad, $param_img, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_especie = $especie;
            $param_raza = $raza;
            $param_edad = $edad;
            $param_img = $img;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde";
            }
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM animales WHERE id = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombre = $row["nombre"];
                    $especie = $row["especie"];
                    $raza = $row["raza"];
                    $edad = $row["edad"];
                    $img = $row["img"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde";
            }
        }
        
        // Close statement
        $stmt->close();
        
        // Close connection
        $mysqli->close();
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
    <title>Actualizar Registro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Actualizar Registro</h2>
                    <p>Edite los valores de entrada y envíelos para actualizar el registro del animal</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                    <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Especie</label>
                            <textarea name="especie" class="form-control <?php echo (!empty($especie_err)) ? 'is-invalid' : ''; ?>"><?php echo $especie; ?></textarea>
                            <span class="invalid-feedback"><?php echo $especie_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Raza</label>
                            <textarea name="raza" class="form-control <?php echo (!empty($raza_err)) ? 'is-invalid' : ''; ?>"><?php echo $raza; ?></textarea>
                            <span class="invalid-feedback"><?php echo $raza_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Edad</label>
                            <textarea name="edad" class="form-control <?php echo (!empty($edad_err)) ? 'is-invalid' : ''; ?>"><?php echo $edad; ?></textarea>
                            <span class="invalid-feedback"><?php echo $edad_err;?></span>
                        </div>


                        <div class="form-group">
                            <label>Imagen</label>
                            <textarea name="img" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>"><?php echo $img; ?></textarea>
                            <span class="invalid-feedback"><?php echo $img_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-dark" value="Enviar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>