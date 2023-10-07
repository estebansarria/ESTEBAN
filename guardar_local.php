<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se enviaron datos de imagen
    if (isset($_POST['nombre']) && isset($_POST['ubicacion']) && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Conexión a la base de datos (debes completar los datos)
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

        // Limpiar y escapar datos del formulario para prevenir SQL injection
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $ubicacion = $conn->real_escape_string($_POST['ubicacion']);

        $imagen = $_FILES['imagen'];
        $nombreImagen = $conn->real_escape_string($imagen['name']); // Nombre de la imagen
        $rutaDestino = 'img/' . $nombreImagen; // Ruta donde se guardará la imagen

        // Verificar tipo de archivo y guardarlo
        $allowedImageTypes = array('image/jpeg', 'image/png');
        if (in_array($_FILES['imagen']['type'], $allowedImageTypes)) {
            if (move_uploaded_file($imagen['tmp_name'], $rutaDestino)) {
                // Insertar datos en la tabla "locales" con la ruta de la imagen
                $sql = "INSERT INTO locales (nombre, ubicacion, imagen) VALUES ('$nombre', '$ubicacion', '$rutaDestino')";

                if ($conn->query($sql) === TRUE) {
                    echo "Local registrado exitosamente con imagen.";
                } else {
                    echo "Error al registrar el local: " . $conn->error;
                }
            } else {
                echo "Error al guardar la imagen en el servidor.";
            }
        } else {
            echo "Formato de imagen no válido. Solo se permiten archivos JPEG y PNG.";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "Error al subir la imagen. Asegúrate de que se seleccionó una imagen.";
    }
} else {
    echo "Acceso no válido.";
}
?>
