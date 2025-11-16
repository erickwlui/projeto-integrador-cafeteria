<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function login()
    {
        include __DIR__ . '/../views/login.php';
    }

    public function fazerLogin()
    {
        $usuario = trim($_POST['usuario'] ?? '');
        $senha   = trim($_POST['senha'] ?? '');

        if ($usuario === "admin" && $senha === "1234") {
            $_SESSION['admin_id']   = 1;
            $_SESSION['admin_nome'] = "Administrador";

            $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            if ($basePath === '.' || $basePath === DIRECTORY_SEPARATOR) {
                $basePath = '';
            }

            header("Location: {$basePath}/index.php");
            exit;
        }

        $erro = "Credenciais inválidas.";
        include __DIR__ . '/../views/login.php';
    }

    public function logout()
    {
        session_destroy();
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        if ($basePath === '.' || $basePath === DIRECTORY_SEPARATOR) {
            $basePath = '';
        }
        header("Location: {$basePath}/login.php");
        exit;
    }
}