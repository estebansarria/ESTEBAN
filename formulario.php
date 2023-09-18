<?php
// Establecer la conexión a la base de datos (reemplaza los valores con los adecuados para tu base de datos)
// Conexión a la base de datos (debes completar los datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre-taller-1'];
    $telefono = $_POST['telefono-taller-1'];
    $correo = $_POST['correo-taller-1'];
    $tipo = $_POST['tipo-mantenimiento-taller-1'];
    $marca = $_POST['marca-moto-taller-1'];
    $placa = $_POST['placa-moto-taller-1'];
    $fecha = $_POST['fecha-ingreso-taller-1'];
    $hora = $_POST['hora-ingreso-taller-1'];
    $id_local = $_POST['id_local'];

    // Insertar los datos en la tabla 'reservas'
    $sql = "INSERT INTO reservas (nombre, telefono, correo, placa_moto, tipo_mantenimiento, marca_moto, fecha_ingreso, hora_ingreso, id_local)  
    VALUES ('$nombre', '$telefono', '$correo', '$placa', '$tipo', '$marca', '$fecha', '$hora', '$id_local')";

    if (mysqli_query($conn, $sql)) {
        echo "<script> Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Te has registrado correctamente',
            showConfirmButton: false,
            timer: 1500
        })</script>";
        echo "<script> window.location('index.php');</script>";
    } else {
        // Manejo de errores en caso de que la inserción falle
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }
}

// Cerrar la conexión a la base de datos al finalizar el script (opcional, pero recomendado)
mysqli_close($conn);
?>

