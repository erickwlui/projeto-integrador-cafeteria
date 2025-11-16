<?php

require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/../../models/Cliente.php';

class AdminClienteController extends AdminController
{
    private Cliente $clienteModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->clienteModel = new Cliente($pdo);
    }

    public function listar()
    {
        $clientes = $this->clienteModel->getAll();
        include __DIR__ . '/../views/clientes/listar.php';
    }

    public function cadastrar()
    {
        include __DIR__ . '/../views/clientes/cadastrar.php';
    }

    public function salvar()
    {
        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'endereco' => $_POST['endereco']
        ];

        $this->clienteModel->create($dados);

        header("Location: index.php?controller=clientes&action=listar");
        exit;
    }

    public function editar()
    {
        $id = (int)$_GET['id'];
        $cliente = $this->clienteModel->find($id);

        include __DIR__ . '/../views/clientes/editar.php';
    }

    public function atualizar()
    {
        $id = (int)$_POST['id'];

        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'endereco' => $_POST['endereco']
        ];

        $this->clienteModel->update($id, $dados);

        header("Location: index.php?controller=clientes&action=listar");
        exit;
    }

    public function excluir()
    {
        $id = (int)$_GET['id'];
        try {
            $this->clienteModel->delete($id);
            $this->redirectComAviso('clientes', 'listar', 'Cliente excluído com sucesso!');
        } catch (PDOException $e) {
            $mensagem = $e->getCode() === '23000'
                ? 'Não é possível excluir o cliente porque existem pedidos associados.'
                : 'Erro ao excluir o cliente. Tente novamente.';
            $this->redirectComAviso('clientes', 'listar', $mensagem, 'erro');
        }
    }
}