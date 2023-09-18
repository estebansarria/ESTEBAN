<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/servicios.css">
    <title>Formulario para Servicios</title>
</head>
<body>
    <h1>Registro de Servicios</h1>
    <form action="guardar_servicio.php" method="POST">
        <label for="nombre">Nombre del Servicio:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="costo">Costo del Servicio:</label>
        <input type="text" id="costo" name="costo" required><br><br>
        
        <label for="local">Local:</label>
        <select id="local" name="id_local" required>
            <option value="" disabled selected>Seleccione un local</option>
            <?php
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

            // Obtener locales registrados
            $sql = "SELECT id_local, nombre FROM locales";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id_local'] . '">' . $row['nombre'] . '</option>';
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </select><br><br>
        
        <input type="submit" value="Guardar Servicio">
    </form>
</body>
</html>
