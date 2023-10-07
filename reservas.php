<?php
session_start();

$usuarioHaIniciadoSesion = isset($_SESSION['usuario_id']); // Cambiar con tu lógica de autenticación

if (!$usuarioHaIniciadoSesion) {
    header("Location: iniciarseccion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="css/reservas2.css">
</head>
<body>
   
    <div class="container">
        <div class="promo-container">
        <h2>RESERVA YA!!!!</h2>
            <p>"¡No pierdas más tiempo! Reserva tu cita ahora mismo y asegura tu espacio para recibir el mejor servicio. Nuestro equipo está listo para atenderte. Llama o visita nuestro sitio web para reservar tu cita hoy mismo. ¡No esperes más para cuidarte y consentirte!"</p>
        </div>
        <div class="form-container">
        <h2>Completa el formulario de reserva</h2>
            <form action="procesar_formulario.php" method="POST">

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>

                <label for="placa_moto">Placa de la Moto:</label>
                <input type="text" id="placa_moto" name="placa_moto" required>

                <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
                <select id="tipo_mantenimiento" name="tipo_mantenimiento" required>
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

                    $queryServicios = "SELECT * FROM servicios";
                    $resultServicios = $conn->query($queryServicios);

                    while ($servicio = mysqli_fetch_assoc($resultServicios)) {
                        echo '<option value="' . $servicio['id'] . '">' . $servicio['nombre'] . '</option>';
                    }

                    $conn->close();
                    ?>
                </select>

                <label for="marca_moto">Marca de la Moto:</label>
                <input type="text" id="marca_moto" name="marca_moto" required>

                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

                <label for="hora_ingreso">Hora de Ingreso:</label>
                <input type="time" id="hora_ingreso" name="hora_ingreso" required>

                <label for="tipo_local">Tipo de Local:</label>
                <select id="tipo_local" name="tipo_local" required>
    
    
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

    $queryLocales = "SELECT * FROM locales";
    $resultLocales = $conn->query($queryLocales);

    while ($local = mysqli_fetch_assoc($resultLocales)) {
        echo '<option value="' . $local['id_local'] . '">' . $local['nombre'] . '</option>';
    }

    $conn->close();
    ?>

</select>
</select>

                <input type="submit" value="Enviar">
                </form>
        </div>
    </div>
</body>
</html>
