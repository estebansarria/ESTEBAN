<?php
session_start();

$usuarioHaIniciadoSesion = isset($_SESSION['usuario_id']); // Cambiar con tu lógica de autenticación

if (!$usuarioHaIniciadoSesion) {
    header("Location: iniciarseccion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_SESSION["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_SESSION["correo"];
    $placaMoto = $_POST["placa_moto"];
    $tipoMantenimientoId = $_POST["tipo_mantenimiento"]; // Cambio: ahora obtenemos el ID del tipo de mantenimiento
    $marcaMoto = $_POST["marca_moto"];
    $fechaIngreso = $_POST["fecha_ingreso"];
    $horaIngreso = $_POST["hora_ingreso"];
    $tipoLocalId = $_POST["tipo_local"]; // Cambio: ahora obtenemos el ID del local
    $idUsuario = $_SESSION['usuario_id'];
// Conexión a la base de datos (debes completar los datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $queryLocal = "SELECT nombre FROM locales WHERE id_local = '$tipoLocalId'";
    $resultLocal = $conn->query($queryLocal);
    $localRow = mysqli_fetch_assoc($resultLocal);
    $nombreLocal = $localRow['nombre'];

    // Cambio: Obtenemos el nombre del tipo de mantenimiento y del local usando sus IDs
    $queryTipoMantenimiento = "SELECT nombre FROM servicios WHERE id = '$tipoMantenimientoId'";
    $resultTipoMantenimiento = $conn->query($queryTipoMantenimiento);
    $tipoMantenimientoRow = mysqli_fetch_assoc($resultTipoMantenimiento);
    $nombreTipoMantenimiento = $tipoMantenimientoRow['nombre'];

    $queryInsertReserva = "INSERT INTO reservas (nombre, telefono, correo, placa_moto, tipo_mantenimiento, marca_moto, fecha_ingreso, hora_ingreso, id_local, id_usuario) VALUES ('$nombre', '$telefono', '$correo', '$placaMoto', '$nombreTipoMantenimiento', '$marcaMoto', '$fechaIngreso', '$horaIngreso', '$nombreLocal', '$idUsuario')";

    if ($conn->query($queryInsertReserva) === TRUE) {
        header("Location: tus_citas.php");
    } else {
        echo "Error al crear la reserva: " . $conn->error;
    }

    $conn->close();
}
?>
