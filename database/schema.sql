-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS kiero_burguer;
USE kiero_burguer;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS tbl_login (
    ID_Login INT AUTO_INCREMENT PRIMARY KEY,
    User_Login VARCHAR(50) NOT NULL UNIQUE,
    Nome_Login VARCHAR(100) NOT NULL,
    Email_Login VARCHAR(100) NOT NULL UNIQUE,
    Senha_Login VARCHAR(255) NOT NULL,
    CPF_Login VARCHAR(14) NOT NULL UNIQUE,
    CEP_Login VARCHAR(9) NOT NULL,
    Logradouro_Login VARCHAR(100) NOT NULL,
    Numero_Login VARCHAR(10) NOT NULL,
    Complemento_Login VARCHAR(100),
    Bairro_Login VARCHAR(100) NOT NULL,
    Cidade_Login VARCHAR(100) NOT NULL,
    Estado_Login CHAR(2) NOT NULL,
    Tipo_Usuario TINYINT NOT NULL DEFAULT 0,
    Data_Criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Data_Atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de categorias
CREATE TABLE IF NOT EXISTS tbl_categorias (
    ID_Categoria INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Categoria VARCHAR(50) NOT NULL,
    Descricao_Categoria TEXT,
    Status_Categoria TINYINT NOT NULL DEFAULT 1,
    Data_Criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Data_Atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS tbl_produtos (
    ID_Produto INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Produto VARCHAR(100) NOT NULL,
    Descricao_Produto TEXT,
    Preco_Produto DECIMAL(10,2) NOT NULL,
    Imagem_Produto VARCHAR(255),
    ID_Categoria INT NOT NULL,
    Status_Produto TINYINT NOT NULL DEFAULT 1,
    Data_Criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Data_Atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_Categoria) REFERENCES tbl_categorias(ID_Categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de pedidos
CREATE TABLE IF NOT EXISTS tbl_pedidos (
    ID_Pedido INT AUTO_INCREMENT PRIMARY KEY,
    ID_Login INT NOT NULL,
    Data_Pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Status_Pedido TINYINT NOT NULL DEFAULT 0,
    Forma_Pagamento ENUM('card', 'cash') NOT NULL,
    Valor_Total DECIMAL(10,2) NOT NULL,
    Observacao_Pedido TEXT,
    Data_Atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_Login) REFERENCES tbl_login(ID_Login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de itens do pedido
CREATE TABLE IF NOT EXISTS tbl_itens_pedido (
    ID_Item_Pedido INT AUTO_INCREMENT PRIMARY KEY,
    ID_Pedido INT NOT NULL,
    ID_Produto INT NOT NULL,
    Quantidade INT NOT NULL,
    Preco_Unitario DECIMAL(10,2) NOT NULL,
    Subtotal DECIMAL(10,2) NOT NULL,
    Observacao_Item TEXT,
    FOREIGN KEY (ID_Pedido) REFERENCES tbl_pedidos(ID_Pedido),
    FOREIGN KEY (ID_Produto) REFERENCES tbl_produtos(ID_Produto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserção de dados iniciais
INSERT INTO tbl_categorias (Nome_Categoria, Descricao_Categoria) VALUES
('Hambúrgueres', 'Nossos deliciosos hambúrgueres artesanais'),
('Bebidas', 'Bebidas geladas para acompanhar'),
('Acompanhamentos', 'Porções e fritas'),
('Sobremesas', 'Doces e sobremesas');

-- Inserção de produtos de exemplo
INSERT INTO tbl_produtos (Nome_Produto, Descricao_Produto, Preco_Produto, ID_Categoria) VALUES
('X-Burguer', 'Hambúrguer com queijo, alface, tomate e molho especial', 25.90, 1),
('X-Bacon', 'Hambúrguer com queijo, bacon, alface, tomate e molho especial', 29.90, 1),
('Coca-Cola', 'Refrigerante Coca-Cola 350ml', 6.90, 2),
('Batata Frita', 'Porção de batata frita crocante', 15.90, 3),
('Sorvete', 'Sorvete de creme com calda de chocolate', 12.90, 4);

-- Inserção de usuário administrador
INSERT INTO tbl_login (User_Login, Nome_Login, Email_Login, Senha_Login, CPF_Login, CEP_Login, Logradouro_Login, Numero_Login, Bairro_Login, Cidade_Login, Estado_Login, Tipo_Usuario) VALUES
('admin', 'Administrador', 'admin@kieroburger.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '123.456.789-00', '12345-678', 'Rua Exemplo', '123', 'Centro', 'São Paulo', 'SP', 1); 