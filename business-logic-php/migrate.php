<?php
$env = parse_ini_file(__DIR__ . '/../.env');

try {
    $pdo = new PDO("mysql:host={$env['DB_HOST']};port={$env['DB_PORT']}", $env['DB_USER'], $env['DB_PASS']);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$env['DB_NAME']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $pdo->exec("USE `{$env['DB_NAME']}`;");

    // Tabla Usuarios con todos los campos 
    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP()
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // Tabla Status
    $pdo->exec("CREATE TABLE IF NOT EXISTS sistema_status (
        id INT PRIMARY KEY, 
        fusible_estado VARCHAR(20)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Datos Iniciales
    $hash = '$2b$12$6y97t9B7vLAsK3V1bcS9hu6S6S0.5N9E6Y6u6u6u6u6u6u6u6u6u6'; // admin123
    $pdo->prepare("INSERT IGNORE INTO usuarios (username, password_hash, email) VALUES ('admin', ?, 'admin@ecosystem.com')")
        ->execute([$hash]);
    
    $pdo->exec("INSERT IGNORE INTO sistema_status (id, fusible_estado) VALUES (1, 'CERRADO')");

    echo "✅ Base de datos migrada con la estructura exacta (incluye email y created_at).\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}