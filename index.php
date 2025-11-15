<?php
require_once __DIR__ . '/config/conexao.php';

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'cliente':
        require_once __DIR__ . '/controllers/ClienteController.php';
        $controllerInstance = new ClienteController($pdo);
        break;

    case 'produto':
        require_once __DIR__ . '/controllers/ProdutoController.php';
        $controllerInstance = new ProdutoController($pdo);
        break;

    case 'pedido':
        require_once __DIR__ . '/controllers/PedidoController.php';
        $controllerInstance = new PedidoController($pdo);
        break;

    case 'loja':
        require_once __DIR__ . '/controllers/LojaController.php';
        $controllerInstance = new LojaController($pdo);
        break;

    case 'home':
        $controllerInstance = null;
        break;
        
    case 'payment':
        require_once __DIR__ . '/controllers/PaymentController.php';
        $controllerInstance = new PaymentController($pdo);
        break;
    default:
        http_response_code(404);
        echo '<h1>404 - Página não encontrada</h1>';
        exit;
}

if ($controller === 'home') {
    include __DIR__ . '/views/home.php';
    exit;
}

if (!method_exists($controllerInstance, $action)) {
    $action = 'index';
}

$controllerInstance->{$action}();