<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo | EcoSystem</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        :root { --spacing: 2rem; }
        .admin-card { max-width: 600px; margin: 50px auto; border: 1px solid #333; }
        .status-indicator { font-size: 2rem; font-weight: bold; padding: 10px; border-radius: 8px; }
        .CERRADO { color: #2ecc71; background: rgba(46, 204, 113, 0.1); }
        .ABIERTO { color: #e74c3c; background: rgba(231, 76, 60, 0.1); }
    </style>
</head>
<body class="container">
    <article class="admin-card">
        <header>
            <hgroup>
                <h1>Panel de Control Interno</h1>
                <h2>Simulador de Errores de Negocio</h2>
            </hgroup>
        </header>

        <div style="text-align: center;">
            <p>Estado actual del sistema en MySQL:</p>
            <div class="status-indicator <?= $status['fusible_estado'] ?>">
                <?= $status['fusible_estado'] ?>
            </div>
        </div>

        <footer>
            <form method="POST">
                <input type="hidden" name="actual" value="<?= $status['fusible_estado'] ?>">
                <button type="submit" name="toggle" class="contrast outline">
                    Alternar Estado (Simular Falla/Arreglo)
                </button>
            </form>
            <p style="font-size: 0.8rem; color: #666; text-align: center;">
                Nota: Este botón afecta directamente la base de datos que Go y Rust están consultando.
            </p>
        </footer>
    </article>
</body>
</html>