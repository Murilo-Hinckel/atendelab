<?php

if (secsion_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuarioautenticado(): bool {
    return isset($_SESSION['usuario_id'])
            && is_array($_SESSION['usuario']);
}

function exigiratenticaco(): void {
    if (!usuarioautenticado()) {
        $_SESSION['mensagem'] =
            'Faca login para acessar a area restrita.';

        header('Location: ?controller=auth&action=login');
        exit;
    }
}

function usuarioatual(): ?array{
    return $_SESSION['usuario'] ?? null;
}

