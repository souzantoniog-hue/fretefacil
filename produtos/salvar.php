<?php
require '../config/conexao.php';

// 1. Receber os dados do formulário
$nome        = $_POST['nome'];
$descricao   = $_POST['descricao'];
$peso        = $_POST['peso'];
$altura      = $_POST['altura'] ?: null;
$largura     = $_POST['largura'] ?: null;
$comprimento = $_POST['comprimento'] ?: null;

// 2. Gravar no banco
$sql = "INSERT INTO produto (nome, descricao, peso, altura, largura, comprimento)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $descricao, $peso, $altura, $largura, $comprimento]);

// 3. Voltar para a lista
header('Location: listar.php');
exit;