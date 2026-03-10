<?php
/**
 * Punto de entrada: Eventos
 * Carga modelos y delega la lógica al controlador.
 */
include_once 'app/usuario/model.php';
session_start();

include_once 'helpers/vars.php';
include_once 'app/evento/model.php';

// El controlador procesa POST/GET y redirige si tiene éxito,
// o deja $accion / $object / $errors para la vista.
include_once 'app/evento/controller.php';
?><!DOCTYPE html>
<html lang="es-MX">
<head>
    <?php include 'templates/head.php'; ?>
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <main class="container">
        <h1>Eventos</h1>

        <?php // ── Mensajes de éxito ──────────────────────────────────────── ?>
        <?php $ok = getvar('ok') ?? ''; ?>

        <?php if ($ok === 'creado'): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa-solid fa-circle-check"></i>
                <strong>Evento creado correctamente.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($ok === 'actualizado'): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa-solid fa-circle-check"></i>
                <strong>Evento actualizado correctamente.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($ok === 'eliminado'): ?>
            <div class="alert alert-warning alert-dismissible fade show">
                <i class="fa-solid fa-trash-can"></i>
                <strong>Evento eliminado.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php // ── Mensajes de error ──────────────────────────────────────── ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endforeach; ?>

        <?php // ── Vista según acción ─────────────────────────────────────── ?>
        <?php if ($accion === 'crear'): ?>
            <?php include 'app/evento/crear.php'; ?>
        <?php elseif ($accion === 'actualizar'): ?>
            <?php include 'app/evento/actualizar.php'; ?>
        <?php elseif ($accion === 'mostrar'): ?>
            <?php include 'app/evento/mostrar.php'; ?>
        <?php else: ?>
            <?php include 'app/evento/listar.php'; ?>
        <?php endif; ?>
    </main>

    <?php include 'templates/footer.php'; ?>
</body>
</html>
