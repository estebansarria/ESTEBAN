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