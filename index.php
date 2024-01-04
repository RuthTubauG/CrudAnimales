<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animales</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .form-control  {
            width: 400px;
            background-color: #c0fff4;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">

                        <!-- BUSCADOR -->
                        <form action="search.php" method="post">
                            <h2>Buscar por especie;</h2><input type="text" name="buscador" class="form-control bg-pink-100"><br>
                            <input type ="submit"class="btn btn-dark">
                            <br><br>
                        </form>

                        <h2 class="pull-left">Animales;</h2>
                        <a href="create.php" class="btn btn-dark pull-right"><i class="fa fa-plus"></i> Añade un animal</a>
                    </div>

                    <!--DIV CONTENEDOR PADRE  -->
                    <div id="padre">

                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM animales";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                                while($row = $result->fetch_array()){
                                    echo "<div class='ficha'>";
                                        echo "<h4>".$row['id']."</h4>";
                                        echo "<h3>".$row['nombre']."</h3>";
                                        echo "<p>".$row['especie']."</p>";
                                        echo "<p>".$row['raza']."</p>";
                                        echo "<p>".$row['edad']."</p>";
                                        echo "<img src=".$row['img']." alt='error'></img>";	
                                        echo "<br/>";
                                        echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="Ver Registro" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                        echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Actualizar Registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        echo '<a href="delete.php?id='. $row['id'] .'" title="Eliminar Registro" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "</div>";
                                }
                                    
                                // Free result set
                                $result->free();
                            } else{
                                echo '<div class="alert alert-danger"><em>No se encontraron registros.</em></div>';
                            }
                        } else{
                            echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
                        }
                        
                        // Close connection
                        $mysqli->close();
                        ?>
                    </div>
            </div>        
        </div>
    </div>
</body>
</html>