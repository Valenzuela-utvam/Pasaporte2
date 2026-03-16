<?php
include_once "app/usuario/model.php";
session_start();

include_once 'helpers/vars.php';

// 1. Seguridad: Verificar sesión y permisos
if (!isset($_SESSION["current_user"]) || !$_SESSION["current_user"]->can("lector_qr.*")) {
    header("Location: index.php");
    exit();
}

// 2. Cargar lógica del controlador
require_once 'app/lectorqr/lectorqrcontroller.php';
$controller = new LectorQRController();

$accion = getvar('accion') ?? getvar('action');

// 3. Manejo de peticiones específicas (AJAX/API)
if ($accion === 'view_sql' && getvar('file')) {
    echo $controller->getSql(getvar('file'));
    exit;
}

// 4. MOSTRAR LA INTERFAZ (Esto es lo que falta)
// Aquí cargamos los archivos visuales para que la página no esté en blanco
 
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <?php include 'templates/head.php'; ?>
</head>
<body class="d-flex flex-column vh-100">
    <?php include 'templates/header.php'; ?>

    <main class="container mt-4 flex-grow-1">
        <div class="card shadow custom-border">
            <div class="card-body text-center">
                <h2 class="mb-4">Lector de Códigos QR</h2>
                
                <button class="btn btn-primary mb-3" onclick="toggleLector()">
                    <i class="fa-solid fa-camera"></i> Activar Cámara
                </button>

                <div id="qr-reader" class="mx-auto" style="width: 100%; max-width: 500px; display: none;"></div>
                
                <div id="qr-reader-results" class="mt-3"></div>
            </div>
        </div>
    </main>

    <?php include 'templates/footer.php'; ?>
    
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="assets/js/escaner.js"></script>
</body>
</html>