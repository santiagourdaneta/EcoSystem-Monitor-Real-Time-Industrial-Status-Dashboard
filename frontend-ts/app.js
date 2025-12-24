const API_URL = "http://127.0.0.1:8080";

// --- MÓDULO DE MONITOREO ---
async function updateMonitor() {
  try {
    const res = await fetch(`${API_URL}/health`);
    const data = await res.json();
    const ui = document.getElementById("fusible-ui");


    ui.textContent = data.fusible;
    ui.className = "status-badge " + data.fusible; // Esto aplica la clase .ABIERTO

    document.getElementById("time-display").innerText = new Date(
      data.fecha_utc,
    ).toLocaleTimeString();
  } catch (e) {
    const ui = document.getElementById("fusible-ui");
    ui.innerText = "OFFLINE";
    ui.className = "status-badge ABIERTO";

    console.error("Servidor Go fuera de línea");
    const statusElement = document.getElementById("fusible-ui");
    statusElement.textContent = "DESCONECTADO";
    statusElement.className = "status-badge"; // Quita el color
    statusElement.style.color = "gray";
  }
}

// --- INICIALIZACIÓN ---
setInterval(updateMonitor, 5000);
updateMonitor();
