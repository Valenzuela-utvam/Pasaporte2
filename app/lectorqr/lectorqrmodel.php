<?php
include_once __DIR__ . '/../../helpers/db.php';

class LectorQRModel extends Model {

    public function __construct() {
        // Usamos la tabla usuarios para validar los accesos
        parent::__construct('usuario');
    }

    /**
     * Valida los datos crudos del QR y retorna el usuario si existe
     */
    public function validarAcceso($qrRawData) {
        $identificador = null;
        $columna = null;

        // 1. Detectar el tipo de dato basado en el prefijo
        if (strpos($qrRawData, 'mat:') === 0) {
            $identificador = str_replace('mat:', '', $qrRawData);
            $columna = 'matricula';
        } elseif (strpos($qrRawData, 'id:') === 0) {
            $identificador = str_replace('id:', '', $qrRawData);
            $columna = 'id';
        }

        if (!$identificador || !$columna) {
            throw new Exception("Formato de código QR no reconocido.");
        }

        // 2. Buscar en la base de datos
        // Usamos el helper de la clase Model para buscar por columna
        $usuarioData = $this->select("$columna = ?", [$identificador]);

        if (!$usuarioData) {
            throw new Exception("Usuario no encontrado en el sistema.");
        }

        return $usuarioData;
    }

    /**
     * Registra el evento de asistencia (Opcional, si tienes tabla de asistencia)
     */
    public function registrarEntrada($usuarioId) {
        // Aquí podrías usar un parent::__construct('asistencia') temporal 
        // o ejecutar un SQL directo para insertar el registro.
    }
}