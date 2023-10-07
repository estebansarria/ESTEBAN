<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talleres de Mantenimiento de Motos</title>
    <link rel="stylesheet" href="css/nueva.css">
    <script src="https://kit.fontawesome.com/d3f9b72ddb.js" crossorigin="anonymous"></script>
  

  <!-- Encabezado y estilos -->
</head>
<body>
 
<header>
 
  <h2 class="reparacion" >RETRO REPARACION</h2>
  </section>
  <nav>
    <div class="solicitar">
    <!-- Botón de "Solicitar Cita" -->
    <?php
    if (isset($_SESSION['usuario_id'])) {   
      echo '<a class="registrar" href="iniciarseccion.php">INICIAR SESIÓN</a>';
      echo '<a class="registrar" href="tus_citas.php">TUS CITAS</a>';
      echo '<a class="registrar" href="cerrar_sesion.php">CERRAR SESÍON</a>';
    } else {
      echo '<a class="cta-button" href="iniciarseccion.php">INICIAR SESIÓN</a>';
      echo '<a class="registrar" href="registrarse.php">REGISTRARSE</a>';

    }
    ?>
	</div>
    <!-- Encabezado y menú de navegación -->
		<script>
			function redireccionar() {
				// Cambia la URL por la que deseas redireccionar
				window.location.href = "citas.php";
			  }
			</script>
	</button>
      </nav>
      </header>
      
      <div class="titulo">
        <h1>TALLERES</h1>
      </div>

  <main>
    <!-- Sección de talleres -->
    <section class="talleres-section">
   
		<div class="locales-container">
        
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

                function obtenerServiciosPorLocal($idLocal) {
                    global $conn;
                    $queryServicios = "SELECT * FROM servicios WHERE id_local = $idLocal";
                    return $conn->query($queryServicios);
                }

                while ($local = mysqli_fetch_assoc($resultLocales)) {
                    echo '<div class="local-card">';
                    echo '<img src="' . $local['imagen'] . '" alt="' . $local['nombre'] . '" width="160">';
                    echo '<h2>' . $local['nombre'] . '</h2>';
                    echo '<p>Ubicacion:' . $local['ubicacion'] . '</p>';
					echo "<br>";
					echo "<a href='reservas.php'>Reservas</a> ";
                    echo '<details class="servicios-details">';
                    echo '<summary>Servicios</summary>';
                    echo '<ul class="servicios-list">';
                    $servicios = obtenerServiciosPorLocal($local['id_local']);
                    while ($servicio = mysqli_fetch_assoc($servicios)) {
                        echo '<li>' . $servicio['nombre'] . ' - $' . $servicio['costo'] . '</li>';
                    }
                    echo '</ul>';
                    echo '</details>';

                    echo '</div>';
                }

                $conn->close();
                ?>
				
				</div>
			<!-- Agregar más divs "taller" según sea necesario -->
		  </section>

    
  </main>

  <!-- Scripts y otros recursos -->

  <!-- Scripts de JavaScript para el slider -->
  <script>
    // Función para mostrar u ocultar el formulario de reserva según el id del taller
    function mostrarFormulario(idFormulario) {
      var formulario = document.getElementById(idFormulario);
      if (formulario.style.display === "none") {
        formulario.style.display = "block";
      } else {
        formulario.style.display = "none";
      }
    }
  </script>
  <canvas id="waveCanvas"></canvas>
  <footer>
    <article class="articulo2"></article>
    <article class="articulo3">

      <section class="contacto"><h3>CONTACTO</h3></section>
      
      <section class="contacto">
      <div class="icono1"><i class="fa-solid fa-phone"></i></div>
        <p>3219509454</p>
      </section>

      <section class="contacto">
      <div class="icono2"><i class="fa-regular fa-envelope"></i></div>
      <p>estebasarriaquintero@gmail.com
      </section>

      <section class="contacto">
      <div class="icono3"><i class="fa-solid fa-location-dot"></i></div>
      <p>Florencia-Caqueta</section>
      </article>


    <article class="articulo4">
        <h3>QUIENES SOMOS</h3>
        <p>Somos una plataforma para buscar talleres de mantenimiento de motos, ver los servicios que ofrecen y realizar reservas en línea. También ofrece funcionalidades de inicio de sesión y registro de usuarios. La página está diseñada para proporcionar información sobre los talleres y facilitar la interacción de los usuarios con los mismos.</p>
    </article>
    <!-- Nueva sección de contacto -->
</article>
<article class="articulo5">
  <section class="red">
        <h3>REDES</h3>
        </section>
         <section class="redes">
         <article class="redes1">
         <i class="fa-brands fa-facebook"></i>
         </article>

         <article class="redes2">
         <i class="fa-brands fa-instagram"></i>
         </article>

         <article class="redes3">
         <i class="fa-solid fa-envelope"></i>
         </article>
         </section>
       
    </article>

</footer>

    <script>
      const canvas = document.getElementById("waveCanvas");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = 140; // Altura más alta para que las olas estén más bajas

const waveColors = ["white", "rgba(255, 255, 255, 0.6)", "rgba(255, 255, 255, 0.4)"];
const numWaves = waveColors.length;
const speed = 0.007; // Reducir la velocidad de la animación
const amplitudes = [20, 60, 60]; // Aumentar la amplitud para hacer las olas más anchas
const frequencies = [0.008, 0.006, 0.01]; // Reducir la frecuencia para hacer la animación más lenta
const verticalOffsets = [41, 42, 43]; // Ajustar la separación vertical entre las olas para que estén más bajas

let time = 0;

function drawWaves() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (let i = 0; i < numWaves; i++) {
        ctx.fillStyle = waveColors[i];
        ctx.beginPath();

        for (let x = 0; x < canvas.width; x += 10) {
            const y = amplitudes[i] * Math.sin(frequencies[i] * x + time);
            ctx.lineTo(x, canvas.height - (y + verticalOffsets[i]));
        }

        ctx.lineTo(canvas.width, canvas.height);
        ctx.lineTo(0, canvas.height);
        ctx.closePath();
        ctx.fill();
    }

    time += speed;
    requestAnimationFrame(drawWaves);
}

drawWaves();

// Redimensionar el lienzo si cambia el tamaño de la ventana
window.addEventListener("resize", () => {
    canvas.width = window.innerWidth;
    drawWaves();
});
    </script>


    
</body>
</html>



