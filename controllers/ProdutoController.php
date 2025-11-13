<?php
require_once __DIR__ . '/../models/Produto.php';

class ProdutoController
{
    private Produto $produtoModel;

    public function __construct(PDO $pdo)
    {
        $this->produtoModel = new Produto($pdo);
    }

    public function listar(): void
    {
        $produtos = $this->produtoModel->getAll();
        $mensagem = $_GET['mensagem'] ?? '';
        $tipoMensagem = $_GET['tipo'] ?? 'sucesso';
        include __DIR__ . '/../views/produtos/listar.php';
    }

    public function cadastrar(): void
    {
        $erro = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->sanitizarEntrada();
            if ($this->camposObrigatoriosPreenchidos($dados)) {
                $this->produtoModel->create($dados);
                $this->redirecionarComMensagem('Produto salvo com sucesso!');
            } else {
                $erro = 'Preencha todos os campos para cadastrar o produto.';
            }
        }

        $produtoEdit = null;
        include __DIR__ . '/../views/produtos/cadastrar.php';
    }

    public function editar(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id <= 0) {
            $this->redirecionarComMensagem('Produto não encontrado.', 'erro');
        }

        $produtoEdit = $this->produtoModel->find($id);
        if (!$produtoEdit) {
            $this->redirecionarComMensagem('Produto não encontrado.', 'erro');
        }

        $erro = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->sanitizarEntrada();
            if ($this->camposObrigatoriosPreenchidos($dados)) {
                $this->produtoModel->update($id, $dados);
                $this->redirecionarComMensagem('Produto atualizado com sucesso!');
            } else {
                $erro = 'Todos os campos são obrigatórios.';
            }
        }

        include __DIR__ . '/../views/produtos/cadastrar.php';
    }

    public function excluir(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id <= 0) {
            $this->redirecionarComMensagem('Produto não encontrado.', 'erro');
        }

        try {
            $this->produtoModel->delete($id);
            $this->redirecionarComMensagem('Produto excluído com sucesso!');
        } catch (PDOException $e) {
            $this->redirecionarComMensagem('Não foi possível excluir o produto. ' . $e->getMessage(), 'erro');
        }
    }

    private function sanitizarEntrada(): array
    {
        return [
            'nome' => trim($_POST['nome'] ?? ''),
            'descricao' => trim($_POST['descricao'] ?? ''),
            'preco' => (float) str_replace(',', '.', $_POST['preco'] ?? 0),
            'estoque' => (int) ($_POST['estoque'] ?? 0),
        ];
    }

    private function camposObrigatoriosPreenchidos(array $dados): bool
    {
        return $dados['nome'] !== ''
            && $dados['descricao'] !== ''
            && $dados['preco'] > 0
            && $dados['estoque'] >= 0;
    }

    private function redirecionarComMensagem(string $mensagem, string $tipo = 'sucesso'): void
    {
        $query = http_build_query([
            'controller' => 'produto',
            'action' => 'listar',
            'mensagem' => $mensagem,
            'tipo' => $tipo,
        ]);

        header('Location: index.php?' . $query);
        exit;
    }
}
