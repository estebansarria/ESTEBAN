
<?php

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

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $identidad = $_POST['identidad'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['password'];

        if (empty($nombre) || empty($apellido) || empty($identidad) || empty($correo) || empty($contraseña)) {
            echo "<script> alert('Por favor, completa todos los campos antes de enviar el formulario.'); </script>";
            mysqli_close($conn);
            exit();
        }
    
        $sql = "SELECT correo FROM usuarios WHERE correo = '$correo'";
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            echo "<script> alert('El correo electrónico ya está registrado');</script>";
            echo "<script>  window.location.href = 'registrarse.php';</script>";
            mysqli_close($conn);
            exit();
        }
    
        $sql = "INSERT INTO usuarios (nombre, apellido, identidad, correo, contra) VALUES ('$nombre', '$apellido', '$identidad', '$correo', '$contraseña')";
    

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Registrado Correctamente'); </script>";
            echo "<script>  window.location.href = 'iniciarseccion.php';</script>";
        } else {
            echo "Error al insertar los datos: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>

