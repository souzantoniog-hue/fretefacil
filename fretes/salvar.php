<?php
require '../config/conexao.php';

// 1. Receber os dados do formulário
$id_transportador = $_POST['id_transportador'];
$id_origem        = $_POST['id_origem'];
$id_destino       = $_POST['id_destino'];
$data             = $_POST['data'];
$valor            = $_POST['valor'];
$status           = $_POST['status'];
$produtos         = $_POST['produtos'];      // lista com os ids dos produtos
$quantidades      = $_POST['quantidades'];   // lista com as quantidades

// Regra de negócio: origem e destino não podem ser o mesmo endereço
if ($id_origem == $id_destino) {
    die('A origem e o destino precisam ser diferentes. <a href="novo.php">Voltar</a>');
}

// 2. Gravar no banco (tudo ou nada)
$pdo->beginTransaction();

try {
    // 2a. Grava o frete
    $sql = "INSERT INTO frete (id_transportador, id_origem, id_destino, data, valor, status)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_transportador, $id_origem, $id_destino, $data, $valor, $status]);

    // 2b. Pega o id do frete que acabou de ser criado
    $id_frete = $pdo->lastInsertId();

    // 2c. Grava cada produto do frete
    $sqlItem = "INSERT INTO frete_item (id_frete, id_produto, quantidade) VALUES (?, ?, ?)";
    $stmtItem = $pdo->prepare($sqlItem);

    foreach ($produtos as $i => $id_produto) {
        $stmtItem->execute([$id_frete, $id_produto, $quantidades[$i]]);
    }

    // Deu tudo certo: confirma
    $pdo->commit();

} catch (PDOException $e) {
    // Deu erro: desfaz tudo
    $pdo->rollBack();
    die('Erro ao salvar o frete: ' . $e->getMessage());
}

// 3. Voltar para a lista
header('Location: listar.php');
exit;