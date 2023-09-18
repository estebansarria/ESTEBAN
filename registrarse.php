<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registrarse.css">
    <title>Registrarse</title>
</head>
<body>
    <h1>REGISTRARSE</h1>
    <form action="proceso_registro.php" method="POST">

    <input type="text" id=nombre name="nombre" placeholder="Nombre">
    <input type="text"id=apellido name="apellido" placeholder="Apellido">
    <input type="text" id="identidad" name="identidad" placeholder="Identidad">
    <input type="email" id="correo" name="correo" placeholder="Correo">
    <input type="password" id="password" name="password" placeholder="Contraseña" >
    <input type="submit" value="Registrarse" name="registrar"  placeholder="Registrarse">
    </form>
</body>
</html>






