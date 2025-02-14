<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM animales WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
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
    <title>Ver Registro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="ficha">
                        <h4><?php echo $row['id']; ?></h4>
                        <h3><?php echo $row['nombre']; ?></h3>
                        <p><?php echo $row['especie']; ?></p>
                        <p><?php echo $row['raza']; ?></p>
                        <p><?php echo $row['edad']; ?></p>
                        <img src="<?php echo $row['img']; ?>" alt="error">
                        <br/>
                        <a href="read.php?id=<?php echo $row['id']; ?>" class="mr-3" title="Ver Registro" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                        <a href="update.php?id=<?php echo $row['id']; ?>" class="mr-3" title="Actualizar Registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" title="Eliminar Registro" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                    </div>
                    <p><a href="index.php" class="btn btn-dark">Atrás</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>

</html>