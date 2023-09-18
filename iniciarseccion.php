<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/iniciarseccion.css">
    <title>REPARACION Y ALGO MAS</title>
</head>
<body>
<div class="container">
    <div class="seccion1"> 
        <h1>¡Bienvenido a Retro Reparacion!</h1>
        <h3>Registrate y conoce la variedad de talleres y variedad de servicios para tu vehiculo</h3>
    </div>
    <div class="seccion">
        <h2>Iniciar sesión</h2>
        <form action="" method="POST">
            <input type="text" name="correo" placeholder="correo" required><br>
            <input type="password" name="contra" placeholder="contra" required><br>
            <input type="submit" value="Ingresar" class="btn-login">
            <?php
            if (!isset($_SESSION['usuario_id'])) {
                echo '<a class="registrar" href="registrarse.php">Registrarte</a>';
            }
            ?>
        </form>
        
    </div>
</div>

<?php
// Iniciar la sesión (necesario para utilizar $_SESSION)
session_start();

if (isset($_SESSION['usuario_id'])) {
    echo '<script>alert("Ya has iniciado sesión."); window.location.href = "index.php";</script>';
    exit();
}

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Conexión a la base de datos (debes completar los datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contraseña = $_POST['contra'];

    // Realizar la consulta SELECT para validar si los datos existen
    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['contra'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['correo']= $row['correo'];
        $tipo_usuario = $row['tipo_usuario']; // Agrega el campo "tipo" en tu tabla usuarios

        // Verificar la contraseña
        if ($stored_password == $contraseña) {
            // La contraseña es correcta
            if ($tipo_usuario == 'admin') {
                // Usuario administrador, redirigir a index.php
                echo "<script>window.location.href = 'admin/index.html';</script>";
            } elseif ($tipo_usuario == 'usuario') {
                // Usuario normal, redirigir a index.html
                echo "<script>window.location.href = 'index.php';</script>";
            }
        } else {
            // La contraseña ingresada es incorrecta
            echo "La contraseña ingresada es incorrecta";
        }
    } else {
        // Los datos no existen en la base de datos
        echo "El correo electrónico no está registrado";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>

</body>
</html>
