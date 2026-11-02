<?php
require '../config/conexao.php';

$data = $_GET['data'] ?? date('Y-m-d');

// Mesma consulta da tela do relatório
$sql = "SELECT f.id, f.valor, f.status,
               t.nome AS transportador,
               o.cidade AS cidade_origem,
               d.cidade AS cidade_destino,
               (SELECT COUNT(*) FROM frete_item WHERE id_frete = f.id) AS itens
        FROM frete f
        JOIN transportador t ON t.id = f.id_transportador
        JOIN endereco o ON o.id = f.id_origem
        JOIN endereco d ON d.id = f.id_destino
        WHERE f.data = ?
        ORDER BY f.id";

$stmt = $pdo->prepare($sql);
$stmt->execute([$data]);
$fretes = $stmt->fetchAll();

// Avisa o navegador: "isto é um arquivo CSV para baixar"
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="fretes_' . $data . '.csv"');

// Abre a "saída" para escrever o arquivo
$arquivo = fopen('php://output', 'w');

// Faz o Excel entender os acentos (ç, ã, é)
fwrite($arquivo, "\xEF\xBB\xBF");

// Primeira linha: os títulos das colunas
fputcsv($arquivo, ['Nº', 'Transportador', 'Origem', 'Destino', 'Itens', 'Valor (R$)', 'Status'], ';');

// Uma linha para cada frete
foreach ($fretes as $frete) {
    fputcsv($arquivo, [
        $frete['id'],
        $frete['transportador'],
        $frete['cidade_origem'],
        $frete['cidade_destino'],
        $frete['itens'],
        number_format($frete['valor'], 2, ',', '.'),
        $frete['status']
    ], ';');
}

fclose($arquivo);
exit;