package main

import (
	"api-go/handlers"
	"log"
	"net/http"
	"os"

	"github.com/joho/godotenv"
)

func main() {

	// Esto busca el .env subiendo un nivel
	err := godotenv.Load("../.env")
	if err != nil {
		// Si falla, intentamos en la carpeta actual
		godotenv.Load(".env")
	}

	// Si después de cargar, la variable está vacía, lanzamos error
	if os.Getenv("GO_API_PORT") == "" {
		log.Fatal("❌ Error: No se pudieron cargar las variables del .env. Verifica que el archivo esté en la raíz del proyecto.")
	}

	// Definir Rutas (Routing)

	http.HandleFunc("/health", handlers.HealthHandler)
	
	port := os.Getenv("GO_API_PORT")

	log.Printf("🚀 Servidor escuchando en http://0.0.0.0:%s", port)

	serverErr := http.ListenAndServe(":"+port, nil)
	if serverErr != nil {
	    log.Fatalf("❌ ERROR CRÍTICO: %v", serverErr)
	}

}
