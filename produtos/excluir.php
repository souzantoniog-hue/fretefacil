<?php
require '../config/conexao.php';

$id = $_POST['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM produto WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: listar.php');
} catch (PDOException $e) {
    header('Location: listar.php?erro=1');
}
exit;