# Cafeteria Gourmet Digital

Aplicação web em PHP que simula o fluxo completo de uma cafeteria artesanal: vitrine aberta para clientes, funil de compra com checkout via PIX (mock), área autenticada para acompanhar pedidos e painel administrativo protegido para gerenciar o catálogo e a base de clientes.

## Visão geral

- **Stack**: PHP 8+, PDO, MySQL/MariaDB, HTML/CSS e um front-end sem frameworks para facilitar o deploy em ambientes como XAMPP/Laragon.
- **Arquitetura MVC simples**: `controllers/`, `models/` e `views/` para a loja/CRUD público; `admin/` contém o painel protegido.
- **Configuração por ambiente**: `config/conexao.php` carrega `DB_HOST`, `DB_NAME`, `DB_USER` e `DB_PASS` da máquina (ou usa `localhost`, `cafeteria`, `root`, senha vazia).
- **Sessões**: carrinho e autenticação de clientes/admin são mantidos via `$_SESSION`.

```
└── /
    ├── admin/          # Painel administrativo e seus controladores/layouts
    ├── assets/         # CSS da camada pública
    ├── controllers/    # Controladores da loja (clientes, produtos, pedidos, checkout)
    ├── models/         # Camada de acesso ao banco com PDO
    ├── views/          # Telas públicas da aplicação
    ├── config/         # Conexão com o banco
    └── index.php       # Front controller / roteador básico
```

## Funcionalidades principais

- **Loja do cliente**
  - Cadastro/login de clientes e gerenciamento do perfil (endereços simples).
  - Vitrine de produtos com carrinho persistido em sessão, ajuste de quantidades e remoção.
  - Checkout que gera pedidos e itens de pedido e redireciona para um QR Code de PIX fictício.
  - Histórico de compras, com detalhes individuais e controle de acesso por cliente autenticado.
- **Pagamento fictício**
  - Tela de PIX exibe os dados do pedido e simula o QR Code.
  - Endpoint `PaymentController::confirmar` marca o pedido como `pago`.
- **Painel administrativo**
  - Login próprio (credenciais padrão `admin` / `1234`, definido em `admin/controllers/AuthController.php`).
  - Dashboard com totais consolidando produtos, clientes e pedidos.
  - CRUD completo de produtos e clientes e listagem/detalhes de pedidos com seus itens.

## Pré-requisitos

- PHP 8.1+ com extensões `pdo_mysql` habilitadas.
- Servidor web local (Apache/Nginx). O projeto foi desenvolvido com XAMPP e usa URLs relativas (`index.php?controller=...`), dispensando rewrites.
- MySQL ou MariaDB 10+.
- Composer é opcional (o projeto não possui dependências externas).

## Configuração e execução

1. **Clonar o repositório**
   ```bash
   git clone https://seu-servidor/cafeteria.git
   cd cafeteria
   ```
2. **Mover para o diretório servido**  
   Em ambientes XAMPP, copie/clique para `C:\xampp\htdocs\cafeteria` (Windows) ou `/Applications/XAMPP/xamppfiles/htdocs/cafeteria` (macOS/Linux).
3. **Criar o banco de dados**

   ```sql
   CREATE DATABASE cafeteria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   USE cafeteria;

   CREATE TABLE cliente (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(150) NOT NULL,
       email VARCHAR(150) NOT NULL UNIQUE,
       senha VARCHAR(255) NOT NULL,
       endereco VARCHAR(255) NOT NULL
   );

   CREATE TABLE produto (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(150) NOT NULL,
       descricao TEXT NOT NULL,
       preco DECIMAL(10,2) NOT NULL,
       estoque INT NOT NULL DEFAULT 0
   );

   CREATE TABLE pedido (
       id INT AUTO_INCREMENT PRIMARY KEY,
       id_cliente INT NOT NULL,
       total DECIMAL(10,2) NOT NULL,
       status VARCHAR(50) NOT NULL DEFAULT 'aguardando pagamento',
       data_pedido DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
       CONSTRAINT fk_pedido_cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id)
   );

   CREATE TABLE item_pedido (
       id INT AUTO_INCREMENT PRIMARY KEY,
       id_pedido INT NOT NULL,
       id_produto INT NOT NULL,
       quantidade INT NOT NULL,
       subtotal DECIMAL(10,2) NOT NULL,
       CONSTRAINT fk_item_pedido FOREIGN KEY (id_pedido) REFERENCES pedido(id),
       CONSTRAINT fk_item_produto FOREIGN KEY (id_produto) REFERENCES produto(id)
   );
   ```

4. **Configurar credenciais**  
   Ajuste as variáveis de ambiente (ou edite `config/conexao.php`) para apontar para o banco criado:
   ```bash
   export DB_HOST=localhost
   export DB_NAME=cafeteria
   export DB_USER=root
   export DB_PASS=""
   ```
5. **Acessar**
   - Loja pública: `http://localhost/cafeteria/index.php?controller=loja` (consumo, carrinho e pedidos) ou `http://localhost/cafeteria/` para os CRUDs básicos.
   - Painel admin: `http://localhost/cafeteria/admin/` (login `admin` / `1234`). Altere a senha em produção.

## Fluxo recomendado para validar

1. Crie alguns produtos pelo painel administrativo.
2. Cadastre um cliente na loja (`Registrar`).
3. Faça login como cliente, adicione produtos ao carrinho e finalize o pedido.
4. Na tela de PIX, clique em **Confirmar pagamento** para marcar o pedido como pago.
5. Acompanhe o pedido em `Meus pedidos` (cliente) e em `Admin > Pedidos`.

## Boas práticas e próximos passos

- Ative HTTPS e revise o fluxo de autenticação antes de usar em produção (hash de senha, CSRF, etc.).
- Substitua o mock de PIX por uma integração real (Gerencianet, Mercado Pago) caso precise receber pagamentos.
- Ajuste o nível de acesso do painel (usuários reais em vez de credenciais fixas) e considere mover as strings sensíveis para `.env`.
