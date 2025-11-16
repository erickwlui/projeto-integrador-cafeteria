<?php

require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/../../models/Produto.php';

class AdminProdutoController extends AdminController
{
    private Produto $produtoModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->produtoModel = new Produto($pdo);
    }

    public function listar()
    {
        $produtos = $this->produtoModel->getAll();
        include __DIR__ . '/../views/produtos/listar.php';
    }

    public function cadastrar()
    {
        include __DIR__ . '/../views/produtos/cadastrar.php';
    }

    public function salvar()
    {
        $dados = [
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'preco' => (float) $_POST['preco'],
            'estoque' => (int) $_POST['estoque']
        ];

        $this->produtoModel->create($dados);

        header("Location: index.php?controller=produtos&action=listar");
        exit;
    }

    public function editar()
    {
        $id = (int)$_GET['id'];
        $produto = $this->produtoModel->find($id);

        include __DIR__ . '/../views/produtos/editar.php';
    }

    public function atualizar()
    {
        $id = (int)$_POST['id'];

        $dados = [
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'preco' => (float) $_POST['preco'],
            'estoque' => (int) $_POST['estoque']
        ];

        $this->produtoModel->update($id, $dados);

        header("Location: index.php?controller=produtos&action=listar");
        exit;
    }

    public function excluir()
    {
        $id = (int)$_GET['id'];
        try {
            $this->produtoModel->delete($id);
            $this->redirectComAviso('produtos', 'listar', 'Produto excluído com sucesso!');
        } catch (PDOException $e) {
            $mensagem = $e->getCode() === '23000'
                ? 'Não é possível excluir o produto porque ele está vinculado a pedidos.'
                : 'Erro ao excluir o produto. Tente novamente.';
            $this->redirectComAviso('produtos', 'listar', $mensagem, 'erro');
        }
    }
}