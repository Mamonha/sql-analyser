-- Criação do schema
CREATE DATABASE IF NOT EXISTS sql_analyzer;
USE sql_analyzer;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    data_cadastro DATE NOT NULL,
    ativo BOOLEAN DEFAULT TRUE,
    saldo DECIMAL(10,2)
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    data_pedido DATETIME NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    status ENUM('pendente', 'processando', 'enviado', 'entregue', 'cancelado'),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    categoria VARCHAR(50)
);

CREATE TABLE itens_pedido (
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (pedido_id, produto_id),
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

INSERT INTO clientes (nome, email, data_cadastro, ativo, saldo) VALUES
('João Silva', 'joao@email.com', '2023-01-15', TRUE, 1500.00),
('Maria Oliveira', 'maria@email.com', '2023-02-20', TRUE, 2300.50),
('Carlos Souza', 'carlos@email.com', '2023-03-10', FALSE, 500.25),
('Ana Pereira', 'ana@email.com', '2023-01-05', TRUE, 3200.75),
('Pedro Costa', 'pedro@email.com', '2023-04-18', TRUE, 800.00);

INSERT INTO produtos (nome, preco, estoque, categoria) VALUES
('Notebook Elite', 4500.00, 20, 'Eletrônicos'),
('Smartphone Max', 2200.50, 35, 'Eletrônicos'),
('Mesa de Escritório', 899.90, 12, 'Móveis'),
('Cadeira Ergonômica', 650.00, 18, 'Móveis'),
('Teclado Mecânico', 299.90, 42, 'Acessórios');

INSERT INTO pedidos (cliente_id, data_pedido, valor_total, status) VALUES
(1, '2023-05-10 14:30:00', 4500.00, 'entregue'),
(2, '2023-05-12 10:15:00', 1549.90, 'enviado'),
(1, '2023-05-15 09:45:00', 650.00, 'processando'),
(4, '2023-05-18 16:20:00', 5199.90, 'pendente'),
(3, '2023-05-20 11:30:00', 2200.50, 'cancelado');

-- Itens de Pedido
INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES
(1, 1, 1, 4500.00),
(2, 3, 1, 899.90),
(2, 4, 1, 650.00),
(3, 4, 1, 650.00),
(4, 1, 1, 4500.00),
(4, 2, 1, 2200.50),
(5, 2, 1, 2200.50);

CREATE VIEW view_pedidos_clientes AS
SELECT p.id, c.nome AS cliente, p.data_pedido, p.valor_total, p.status
FROM pedidos p
JOIN clientes c ON p.cliente_id = c.id;

CREATE INDEX idx_clientes_nome ON clientes(nome);
CREATE INDEX idx_pedidos_cliente ON pedidos(cliente_id);
CREATE INDEX idx_pedidos_data ON pedidos(data_pedido);