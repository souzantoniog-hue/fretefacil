<?php
require '../config/conexao.php';

// 1. Receber o id do produto
$id = $_POST['id'];

// 2. Apagar do banco
$stmt = $pdo->prepare("DELETE FROM transportador WHERE id = ?");
$stmt->execute([$id]);

// 3. Voltar para a lista
header('Location: listar.php');
exit;