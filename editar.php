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


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtén el ID del registro que se va a editar desde la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEditar = $_GET['id'];
    
    // Cambio: Asegúrate de que el registro a editar pertenezca al usuario actual
    $idUsuario = $_SESSION['usuario_id'];
    $queryEditar = "SELECT * FROM reservas WHERE id = '$idEditar' AND id_usuario = '$idUsuario'";
    $resultEditar = $conn->query($queryEditar);

    if ($resultEditar->num_rows === 1) {
        $registro = mysqli_fetch_assoc($resultEditar);
    } else {
        echo "No se encontró el registro o no tienes permisos para editarlo.";
        exit();
    }
} else {
    echo "ID de registro no válido.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario de edición
    $nuevoNombre = $_POST["nuevo_nombre"];
    // Agrega aquí las demás variables para editar otros campos si es necesario.

    // Consulta para actualizar el registro
    $queryActualizar = "UPDATE reservas SET nombre = '$nuevoNombre' WHERE id = '$idEditar'";

    if ($conn->query($queryActualizar) === TRUE) {
        header("Location: tus_citas.php");
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/editar.css">
    <title>Editar Registro</title>
</head>
<body>
    <h2 class="titulo">Editar Registro</h2>
    <div class="formulario">
    <form method="POST" action="">
        <!-- Agrega aquí los campos de edición para los datos del registro -->
        <input type="hidden" name="id_editar" value="<?php echo $idEditar; ?>">
        
        <label for="nuevo_nombre">Nuevo Nombre:</label>
        <input type="text" name="nuevo_nombre" value="<?php echo $registro['nombre']; ?>" required><br>
        <label for="nuevo_telefono">Nuevo Teléfono:</label>
        <input type="text" name="nuevo_telefono" value="<?php echo $registro['telefono']; ?>"><br>
        
        <label for="nuevo_correo">Nuevo Correo:</label>
        <input type="email" name="nuevo_correo" value="<?php echo $registro['correo']; ?>"><br>
        
        <label for="nueva_placa">Nueva Placa Moto:</label>
        <input type="text" name="nueva_placa" value="<?php echo $registro['placa_moto']; ?>"><br>
        
        <label for="nuevo_mantenimiento">Nuevo Tipo Mantenimiento:</label>
        <select name="nuevo_mantenimiento">
            <option value="Mantenimiento 1">Mantenimiento 1</option>
            <option value="Mantenimiento 2">Mantenimiento 2</option>
            <!-- Agrega aquí las opciones según tu base de datos -->
        </select><br>
        
        <label for="nueva_marca">Nueva Marca Moto:</label>
        <input type="text" name="nueva_marca" value="<?php echo $registro['marca_moto']; ?>"><br>
        
        <label for="nueva_fecha">Nueva Fecha Ingreso:</label>
        <input type="date" name="nueva_fecha" value="<?php echo $registro['fecha_ingreso']; ?>"><br>
        
        <label for="nueva_hora">Nueva Hora Ingreso:</label>
        <input type="time" name="nueva_hora" value="<?php echo $registro['hora_ingreso']; ?>"><br>
        
        <label for="nuevo_local">Nuevo Local:</label>
        <select name="nuevo_local">
            <option value="Local 1">Local 1</option>
            <option value="Local 2">Local 2</option>
            <!-- Agrega aquí las opciones según tu base de datos -->
        </select><br>
        
        <input type="submit" value="Guardar Cambios">
    </form>
    </div>
</body>
</html>


