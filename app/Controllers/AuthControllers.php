<?php

require_once __DIR__ . '/../../config/database.php';

require_once __DIR__ . '/../Middware/auth.php';

class AuthController
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo;

        $this->pdo = $pdo;
    }

    public function exibirlogin(): void{
        if (usuarioautenticado()) {
            header('Location: ?controller=home&action=index');
            exit;
        }

        $erro = $_SESSION['erro_login'] ?? null;
        $mensagem = $_SESSION['mensagem'] ?? null;

        unset($_SESSION['erro_login'], $_SESSION['mensagem']);

        require __DIR__ . '/../Views/auth/login.php';
    }

    public function entrar(): void{
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
            $_SESSION['erro_login'] = 'Informe o email e a senha.';

            header('Location: ?controller=auth&action=login');
            exit;
        }
        
        $sql = 'SELECT id, nome, email, senha, perfil, status
        FROM usuarios 
        WHERE email = :email
        LIMT 1';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (
            !$usuario 
            || $usuario['status'] !== 'ativo'
            || !password_verify($senha, $usuario['senha'])
        )
        
        {
            $_SESSION['erro_login'] = 'Email ou senha inválidos.';

            header('Location: ?controller=auth&action=login');
            exit;
        }
        
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'perfil' => $usuario['perfil']
        ];

        header('Location: ?controller=auth&action=dashboard');
        exit;

    }

    public function dashboard(): void{
        exigiratenticaco();

        $usuario = usuarioatual();

        require __DIR__ . '/../Views/dashboard/index.php';
    }

}