<?php

class FusibleModel {
    private $pdo;

    public function __construct() {
        // Cargar variables de entorno desde la raíz
        $envPath = __DIR__ . '/../.env';
        if (!file_exists($envPath)) {
            throw new Exception("Archivo .env no encontrado");
        }

        $env = parse_ini_file($envPath, false, INI_SCANNER_RAW);
        
        $host = $env['DB_HOST'] ?? '127.0.0.1';
        $db   = $env['DB_NAME'] ?? '';
        $user = $env['DB_USER'] ?? '';
        $pass = $env['DB_PASS'] ?? '';
        $port = $env['DB_PORT'] ?? '3306';

        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            throw new Exception("Fallo en la conexión: " . $e->getMessage());
        }
    }

    /**
     * Obtiene el estado actual del fusible desde la DB
     */
    public function obtenerEstado() {
        $stmt = $this->pdo->query("SELECT fusible_estado FROM sistema_status WHERE id = 1");
        return $stmt->fetch();
    }

    /**
     * Cambia el estado del fusible (Lógica de Negocio)
     */
    public function alternarEstado($estadoActual) {
        $nuevoEstado = ($estadoActual === 'CERRADO') ? 'ABIERTO' : 'CERRADO';
        $stmt = $this->pdo->prepare("UPDATE sistema_status SET fusible_estado = ? WHERE id = 1");
        return $stmt->execute([$nuevoEstado]);
    }
}