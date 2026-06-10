<?php
require_once __DIR__ . 'app/Controllers/UsuarioController.php';

$_controller = $_GET['controller'] ?? 'home';
$_action = $_GET['action'] ?? 'index';

if ($_controller === 'usuario')
{
    UsuarioController = new UsuarioController();

    switch ($_action) {
        case 'listar':
            $usuarioController->listar();
            break;
            
        case 'buscar':
            $usuarioController->buscarPorId();
            break;

        case 'criar':
            $usuarioController->criar();
            break;
            
        case 'atualizar':
            $usuarioController->atualizar();
            break;

        case 'excluir':
            $usuarioController->excluir();
            break;

        default:
            echo "AAAAAAAAAAAAAAAAAAAAAAAAAA__404__AAAAAAAAAAAAAAAAAAAAAAAAAA.";
            break;
    }
}