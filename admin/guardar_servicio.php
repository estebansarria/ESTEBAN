<?php
// Conexión a la base de datos (debes completar los datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombreServicio = $_POST['nombre'];
$costoServicio = $_POST['costo'];
$idLocal = $_POST['id_local'];

// Insertar datos en la tabla "servicios"
$sql = "INSERT INTO servicios (nombre, costo, id_local) VALUES ('$nombreServicio', '$costoServicio', '$idLocal')";

if ($conn->query($sql) === TRUE) {
    echo "Servicio registrado exitosamente.";
} else {
    echo "Error al registrar el servicio: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
