<?php
$accion = getvar("accion");
$errors = [];
if ($accion === 'registrar') {
    $usuario = new Usuario();
    $usuario->fromArray($_POST);
    
    // Requerimientos Activo y NO Admin
    $usuario->activo = 1;
    $usuario->superusuario = 0;

    try {
        if ($usuario->save()) {
            // Redirige al login 
            header("Location: index.php?msg=registered");
            exit();
        } else {
            $errors[] = "No se pudo completar el registro. Intente nuevamente.";
        }
    } catch (Exception $e) {
        $errors[] = "Error al registrar: " . $e->getMessage();
    }
}