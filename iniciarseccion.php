<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    echo '<script>alert("Ya has iniciado sesión."); window.location.href = "index.php";</script>';
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contra'];

    $correo = mysqli_real_escape_string($conn, $correo); // Evitar inyección de SQL
    $contraseña = mysqli_real_escape_string($conn, $contraseña); // Evitar inyección de SQL

    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['contra'];

        if ($contraseña == $stored_password) { // Verificar contraseña con password_verify
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['correo'] = $row['correo'];
            $tipo_usuario = $row['tipo_usuario'];

            if ($tipo_usuario == 'admin') {
                header("Location: admin/index.php"); // Redirigir usando header
                exit();
            } elseif ($tipo_usuario == 'usuario') {
                header("Location: index.php"); // Redirigir usando header
                exit();
            }
        } else {
            echo "La contraseña ingresada es incorrecta";
        }
    } else {
        echo "El correo electrónico no está registrado";
    }

    mysqli_close($conn);
}
?>

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
</body>
</html>
