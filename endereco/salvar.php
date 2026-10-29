<?php
require '../config/conexao.php';

// 1. Receber os dados do formulário
$id          = $_POST['id'];
$cep         = $_POST['cep'];
$rua         = $_POST['rua'];
$numero      = $_POST['numero'];
$complemento = $_POST['complemento'] ?: null;
$bairro      = $_POST['bairro'];
$cidade      = $_POST['cidade'];
$estado      = strtoupper($_POST['estado']);

// 2. Gravar no banco
if ($id) {
    // Veio id: ATUALIZA o endereço que já existe
    $sql = "UPDATE endereco
            SET cep = ?, rua = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $id]);
} else {
    // Não veio id: CRIA um endereço novo
    $sql = "INSERT INTO endereco (cep, rua, numero, complemento, bairro, cidade, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep, $rua, $numero, $complemento, $bairro, $cidade, $estado]);
}

// 3. Voltar para a lista
header('Location: listar.php');
exit;