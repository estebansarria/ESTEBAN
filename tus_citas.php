<?php
session_start();

$usuarioHaIniciadoSesion = isset($_SESSION['usuario_id']);

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

$usuarioId = $_SESSION['usuario_id'];
$queryRegistros = "SELECT * FROM reservas WHERE id_usuario = $usuarioId";
$resultRegistros = $conn->query($queryRegistros);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="css/tus_citas.css">
</head>
<body>
    <header>
        <h1>Reservas</h1>
        <a class="volver" href="index.php">VOLVER</a>
    </header>
    <div class="container">
        <div class="table-container">
            <h2>Registros de reservas</h2>
            <?php
// Conexión a la base de datos (debes completar los datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener los registros del usuario actual
    $idUsuario = $_SESSION['usuario_id'];
    $queryRegistros = "SELECT * FROM reservas WHERE id_usuario = '$idUsuario'";
    $resultRegistros = $conn->query($queryRegistros);

    if ($resultRegistros->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Placa Moto</th><th>Tipo Mantenimiento</th><th>Marca Moto</th><th>Fecha Ingreso</th><th>Hora Ingreso</th><th>Local</th><th>Acciones</th></tr>';
        while ($registro = mysqli_fetch_assoc($resultRegistros)) {
            echo '<tr>';
            echo '<td>' . $registro['nombre'] . '</td>';
            echo '<td>' . $registro['telefono'] . '</td>';
            echo '<td>' . $registro['correo'] . '</td>';
            echo '<td>' . $registro['placa_moto'] . '</td>';
            echo '<td>' . $registro['tipo_mantenimiento'] . '</td>';
            echo '<td>' . $registro['marca_moto'] . '</td>';
            echo '<td>' . $registro['fecha_ingreso'] . '</td>';
            echo '<td>' . $registro['hora_ingreso'] . '</td>';
            echo '<td>' . $registro['id_local'] . '</td>';
            
            // Agrega los botones de Editar y Eliminar para cada registro
            echo '<td>';
            echo '<a class="edita" href="editar.php?id=' . $registro['id'] . '">Editar</a> ';
            echo '<a class="elimina" href="javascript:void(0);" onclick="confirmarEliminacion(' . $registro['id'] . ')">Eliminar</a>';
            echo '</td>';

            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No existen registros para este usuario.</p>';
    }
    
    $conn->close();
    ?>
        </div>
    </div>
    <script>
// Función para mostrar un mensaje de confirmación antes de eliminar
function confirmarEliminacion(id) {
    var confirmar = confirm("¿Estás seguro de que deseas eliminar este registro?");
    if (confirmar) {
        window.location.href = "eliminar.php?id=" + id;
    }
}
</script>
</body>
</html>
