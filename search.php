<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<title>Buscador</title>
</head>
<body>
</body>
</html>

<a href="index.php" class="btn btn-dark">Atrás</a>

<div id="padre">

<?php
$search = $_POST['buscador'];

$servername = "localhost";
$username = "RuthTubau";
$password = "RuthTubau";
$db = "mascotas";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT * FROM animales WHERE especie LIKE '%$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo '<div class="ficha">';
		echo "<h3>".$row['nombre']."</h3>";
        echo "<p>".$row['especie']."</p>";
        echo "<p>".$row['raza']."</p>";
        echo "<p>".$row['edad']."</p>";
        echo "<img src=".$row['img']." alt='error'></img>";	
		echo "<br/>";
		echo '</div>';
	}
} else {
	echo "<h1>0 Resultados</h1>";
}

$conn->close();

?>