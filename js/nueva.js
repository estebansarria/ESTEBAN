function realizarAccion() {
    // Aquí colocas la condición que debe cumplirse para realizar la primera acción
    if (condicionCumplida) {
      console.log("Reserva realizada");
    } else {
      console.log("Por favor, regístrese para reservar");
      window.location="iniciarseccion.php";
    }
  }
  
  // Asignamos la función al evento "click" del botón
  const miBoton = document.getElementById("miBoton");
  miBoton.addEventListener("click", realizarAccion);
  