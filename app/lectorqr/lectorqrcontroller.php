<?php
require_once __DIR__ . '/lectorqrmodel.php';

class LectorQRController {
    private $model;

    public function __construct() {
        $this->model = new LectorQRModel();
    }

    /**
     * Procesa el escaneo
     * Se puede llamar vía POST desde escaner.js
     */
    public function procesarEscaneo($qrData) {
        try {
            if (empty($qrData)) {
                return [
                    'status' => 'error',
                    'message' => 'No se recibieron datos'
                ];
            }

            $usuario = $this->model->validarAcceso($qrData);

            // Aquí puedes añadir validaciones extras, como si el evento está activo
            return [
                'status' => 'success',
                'message' => 'Acceso Concedido',
                'user' => [
                    'nombre' => $usuario['nombre'] ?? 'Usuario',
                    'rol' => $usuario['rol'] ?? 'Invitado'
                ]
            ];

        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}