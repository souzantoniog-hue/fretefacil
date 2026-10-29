<?php
require '../config/conexao.php';

// 1. Receber os dados do formulário
$id            = $_POST['id'];
$nome          = $_POST['nome'];
$documento     = $_POST['documento'];
$telefone      = $_POST['telefone'];
$placa_veiculo = strtoupper($_POST['placa_veiculo']) ?: null;

// 2. Gravar no banco
if ($id) {
    // Veio id: ATUALIZA
    $sql = "UPDATE transportador
            SET nome = ?, documento = ?,telefone = ?, placa_veiculo = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $documento, $telefone, $placa_veiculo, $id]);
} else {
    // Não veio id: CRIA
    $sql = "INSERT INTO transportador (nome, documento, telefone, placa_veiculo)
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $documento, $telefone, $placa_veiculo]);
}

// 3. Voltar para a lista
header('Location: listar.php');
exit;