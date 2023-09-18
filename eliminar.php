<?php
session_start();

$usuarioHaIniciadoSesion = isset($_SESSION['usuario_id']); // Cambiar con tu lógica de autenticación

if (!$usuarioHaIniciadoSesion) {
    header("Location: iniciarseccion.php");
    exit();
}

// Conexión a la base de datos (debes completar los datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idEliminar = $_GET["id"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Cambio: Asegúrate de que el registro a eliminar pertenezca al usuario actual
    $idUsuario = $_SESSION['usuario_id'];
    $queryEliminar = "DELETE FROM reservas WHERE id = '$idEliminar' AND id_usuario = '$idUsuario'";

    if ($conn->query($queryEliminar) === TRUE) {
        header("Location: tus_citas.php");
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
?>