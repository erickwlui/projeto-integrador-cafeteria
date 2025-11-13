<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController
{
    private Cliente $clienteModel;

    public function __construct(PDO $pdo)
    {
        $this->clienteModel = new Cliente($pdo);
    }

    public function listar(): void
    {
        $clientes = $this->clienteModel->getAll();
        $mensagem = $_GET['mensagem'] ?? '';
        $tipoMensagem = $_GET['tipo'] ?? 'sucesso';
        include __DIR__ . '/../views/clientes/listar.php';
    }

    public function cadastrar(): void
    {
        $erro = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->sanitizarEntrada();
            if ($this->camposObrigatoriosPreenchidos($dados)) {
                $this->clienteModel->create($dados);
                $this->redirecionarComMensagem('Cliente salvo com sucesso!');
            } else {
                $erro = 'Preencha todos os campos para cadastrar o cliente.';
            }
        }

        $clienteEdit = null;
        include __DIR__ . '/../views/clientes/cadastrar.php';
    }

    public function editar(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id <= 0) {
            $this->redirecionarComMensagem('Cliente não encontrado.', 'erro');
        }

        $clienteEdit = $this->clienteModel->find($id);
        if (!$clienteEdit) {
            $this->redirecionarComMensagem('Cliente não encontrado.', 'erro');
        }

        $erro = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->sanitizarEntrada();
            if ($this->camposObrigatoriosPreenchidos($dados)) {
                $this->clienteModel->update($id, $dados);
                $this->redirecionarComMensagem('Cliente atualizado com sucesso!');
            } else {
                $erro = 'Todos os campos são obrigatórios.';
            }
        }

        include __DIR__ . '/../views/clientes/cadastrar.php';
    }

    public function excluir(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id <= 0) {
            $this->redirecionarComMensagem('Cliente não encontrado.', 'erro');
        }

        try {
            $this->clienteModel->delete($id);
            $this->redirecionarComMensagem('Cliente excluído com sucesso!');
        } catch (PDOException $e) {
            $this->redirecionarComMensagem('Não foi possível excluir o cliente. ' . $e->getMessage(), 'erro');
        }
    }

    private function sanitizarEntrada(): array
    {
        return [
            'nome' => trim($_POST['nome'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'senha' => trim($_POST['senha'] ?? ''),
            'endereco' => trim($_POST['endereco'] ?? ''),
        ];
    }

    private function camposObrigatoriosPreenchidos(array $dados): bool
    {
        return $dados['nome'] !== ''
            && $dados['email'] !== ''
            && $dados['senha'] !== ''
            && $dados['endereco'] !== '';
    }

    private function redirecionarComMensagem(string $mensagem, string $tipo = 'sucesso'): void
    {
        $query = http_build_query([
            'controller' => 'cliente',
            'action' => 'listar',
            'mensagem' => $mensagem,
            'tipo' => $tipo,
        ]);

        header('Location: index.php?' . $query);
        exit;
    }
}
