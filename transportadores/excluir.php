<?php
require '../config/conexao.php';

$id = $_POST['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM transportador WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: listar.php');
} catch (PDOException $e) {
    // Não deu para excluir: ele já está em algum frete
    header('Location: listar.php?erro=1');
}
exit;