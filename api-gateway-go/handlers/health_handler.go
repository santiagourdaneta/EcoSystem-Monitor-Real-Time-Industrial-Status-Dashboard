package handlers

import (
	"database/sql"
	"encoding/json"
	"fmt"
	"net/http"
	"os"
	"time"

	_ "github.com/go-sql-driver/mysql"
)

func HealthHandler(w http.ResponseWriter, r *http.Request) {

	// Permite que el navegador lea la respuesta desde cualquier origen
	w.Header().Set("Access-Control-Allow-Origin", "*")
	w.Header().Set("Content-Type", "application/json")
	w.Header().Set("Access-Control-Allow-Methods", "GET, OPTIONS")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	if r.Method == "OPTIONS" {
		return
	}

	// Conexión rápida a DB
	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s",
		os.Getenv("DB_USER"), os.Getenv("DB_PASS"),
		os.Getenv("DB_HOST"), os.Getenv("DB_PORT"), os.Getenv("DB_NAME"))

	db, err := sql.Open("mysql", dsn)
	if err != nil {
		http.Error(w, "Error DB", 500)
		return
	}
	defer db.Close()

	var estado string
	err = db.QueryRow("SELECT fusible_estado FROM sistema_status WHERE id=1").Scan(&estado)
	if err != nil {
		estado = "DESCONOCIDO"
	}

	json.NewEncoder(w).Encode(map[string]string{
		"fusible":   estado,
		"fecha_utc": time.Now().Format(time.RFC3339),
	})
}
