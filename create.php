<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombre = $especie = $raza = $edad = $img = "";
$nombre_err = $especie_err = $raza_err = $edad_err = $img_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validar nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
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
        // Prepare an insert statement
        $sql = "INSERT INTO animales (nombre, especie, raza, edad, img) VALUES (?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_nombre, $param_especie, $param_raza, $param_edad, $param_img);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_especie = $especie;
            $param_raza = $raza;
            $param_edad = $edad;
            $param_img = $img;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Registro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crear Registro</h2>
                    <p>Complete este formulario y envíelo para agregar el registro del animal a la base de datos.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <input type="text" name="raza" class="form-control <?php echo (!empty($raza_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $raza; ?>">
                            <span class="invalid-feedback"><?php echo $raza_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Edad</label>
                            <input type="number" name="edad" class="form-control <?php echo (!empty($edad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $edad; ?>">
                            <span class="invalid-feedback"><?php echo $edad_err;?></span>
                        </div>
                    
                        <div class="form-group">
                            <label>Imagen</label>
                            <textarea name="img" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>"><?php echo $img; ?></textarea>
                            <span class="invalid-feedback"><?php echo $img_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-dark" value="Enviar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>