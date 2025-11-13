<?php
$host = getenv('DB_HOST') ?: 'localhost';
$database = getenv('DB_NAME') ?: 'cafeteria';
$usuario = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASS');
$charset = 'utf8mb4';

if ($senha === false) {
    $senha = '';
}

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=$charset",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}
