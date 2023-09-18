<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/locales.css">
    <title>Formulario para Locales</title>
</head>
<body>
    <h1>Registro de Locales</h1>
    
    <form action="../guardar_local.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del Local:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="ubicacion">Ubicación del Local:</label>
        <input type="text" id="ubicacion" name="ubicacion" required><br><br>
        
        <label for="imagen">Imagen del Local:</label>
        <input type="file" name="imagen" accept="image/jpeg, image/png" required><br><br>
        
        <input type="submit" value="Guardar Local">
    </form>
</body>
</html>
