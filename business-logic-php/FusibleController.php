<?php
require_once 'FusibleModel.php';

class FusibleController {
    public function ejecutar() {
        $model = new FusibleModel();
        
        // Si hay una acción, procesamos
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle'])) {
            $model->alternarEstado($_POST['actual']);
            header("Location: index.php"); // Redirige para limpiar el POST
            exit;
        }

        // Obtenemos datos para la vista
        $status = $model->obtenerEstado();
        

        include 'view.php'; 
    }
}