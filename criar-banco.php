<?php
$host = 'localhost:3306';
$user = 'root';
$password = '';
$dbName = 'academia';

$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    die('Falha na conexão: ' . $conn->connect_error);
}

echo "Conectado ao MySQL com sucesso.<br>";

$sql = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados '$dbName' criado (ou já existente).<br>";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error . "<br>";
}

$conn->select_db($dbName);
$conn->set_charset('utf8mb4');

echo "Selecionado o banco de dados '$dbName'.<br>";

// Tabelas
$tables = [

    // Usuários
    'usuarios' => "
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome_usuario VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(200) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    'personais' => "
        CREATE TABLE IF NOT EXISTS personais (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(200)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    'exercicios' => "
        CREATE TABLE IF NOT EXISTS exercicios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome_exercicio VARCHAR(100) NOT NULL,
            descricao VARCHAR(1000),
            imagem VARCHAR(255) NOT NULL,
            personal_id INT,
            FOREIGN KEY (personal_id) REFERENCES personais(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    'planos' => "
        CREATE TABLE IF NOT EXISTS planos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome_plano VARCHAR(100) NOT NULL,
            valor DECIMAL(10,2) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    'plano_exercicios' => "
        CREATE TABLE IF NOT EXISTS plano_exercicios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            plano_id INT NOT NULL,
            exercicio_id INT NOT NULL,
            FOREIGN KEY (plano_id) REFERENCES planos(id) ON DELETE CASCADE,
            FOREIGN KEY (exercicio_id) REFERENCES exercicios(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
];

// Criando tabelas
foreach ($tables as $name => $ddl) {
    if ($conn->query($ddl) === TRUE) {
        echo "Tabela '$name' criada com sucesso.<br>";
    } else {
        echo "Erro ao criar tabela '$name': " . $conn->error . "<br>";
    }
}

// Dados de exemplo
$hashAdmin = password_hash('admin123', PASSWORD_DEFAULT);
$hashUsuario = password_hash('usuario123', PASSWORD_DEFAULT);

$inserts = [

    // Usuários
    "INSERT IGNORE INTO usuarios (nome_usuario, email, senha) VALUES ('admin', 'admin@admin.com.br', '$hashAdmin')",
    "INSERT IGNORE INTO usuarios (nome_usuario, email, senha) VALUES ('usuario', 'usuario@admin.com.br', '$hashUsuario')",

    // Personais
    "INSERT IGNORE INTO personais (nome, email) VALUES ('João Victor', 'joao@academia.com')",
    "INSERT IGNORE INTO personais (nome, email) VALUES ('Maria Clara', 'maria@academia.com')",

    // Exercícios (com imagens)
    "INSERT IGNORE INTO exercicios (nome_exercicio, descricao, imagem, personal_id)
     VALUES ('Rosca com halteres', 'Trabalha o bíceps com halteres.', 'img-1.jpg', 1)",

    "INSERT IGNORE INTO exercicios (nome_exercicio, descricao, imagem, personal_id)
     VALUES ('Agachamento', 'Fortalece pernas, glúteos e quadríceps.', 'img-2.jpg', 2)",

    "INSERT IGNORE INTO exercicios (nome_exercicio, descricao, imagem, personal_id)
     VALUES ('Abdominal reto', 'Trabalha a musculatura abdominal.', 'img-3.jpg', 2)",

    // Planos
    "INSERT IGNORE INTO planos (nome_plano, valor) VALUES ('Básico', 59.90)",
    "INSERT IGNORE INTO planos (nome_plano, valor) VALUES ('Premium', 159.90)",
];

// Executa inserções
foreach ($inserts as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Inserção realizada com sucesso.<br>";
    } else {
        echo "Erro ao inserir: " . $conn->error . "<br>";
    }
}

$conn->close();
echo "<br>Script finalizado.";
?>