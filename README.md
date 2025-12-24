# 🚀 EcoSystem Monitor

Un dashboard de monitoreo de alta eficiencia diseñado con un enfoque en la velocidad y la estética profesional. Este sistema permite supervisar el estado de componentes críticos (como un fusible industrial) en tiempo real.

## 🎨 Características Visuales
- **Diseño Glassmorphism:** Interfaz moderna basada en efectos de cristal esmerilado.
- **Degradados de Alta Profundidad:** Fondo optimizado para reducir la fatiga visual.
- **Resplandor Dinámico:** Los indicadores de estado (CERRADO/ABIERTO) emiten un brillo según su condición.

## 🛠️ Arquitectura Técnica
- **Frontend:** HTML5, CSS3 (Custom Properties) y JavaScript Vanilla (Fetch API).
- **Backend (API Gateway):** Go (Golang) encargado de la lógica de negocio y comunicación con datos.
- **Base de Datos:** MySQL para la persistencia del estado del sistema.

## 📂 Estructura del Proyecto
- `/api-gateway-go`: Servidor en Go que gestiona las peticiones `/health`.
- `/frontend`: Archivos de interfaz (HTML, CSS, JS).
- `/business-logic-php`: Panel administrativo para conmutar estados.

## 🚀 Instalación y Uso

1. **Base de Datos:** Importa la tabla `sistema_status` en tu MySQL y asegúrate de que el servicio esté corriendo (vía XAMPP o nativo).
2. **Backend:**
   ```bash
   cd api-gateway-go
   go run main.go
3.Frontend: Simplemente abre el archivo frontend/index.html en tu navegador favorito.

⚙️ Configuración (.env)
Asegúrate de configurar tus credenciales de base de datos en el archivo raíz: DB_USER=root DB_PASS=tu_password DB_HOST=127.0.0.1 GO_API_PORT=8080

Desarrollado con enfoque en Alta Eficiencia y Arquitectura Limpia.

Go, API-Gateway, MySQL, Real-time, Frontend, Glassmorphism, Clean-Architecture

#GoLang #WebDevelopment #RealTimeMonitoring #CleanCode #FullStack #OpenSource #MySQL
