<?php
require '../config/conexao.php';

$sql = "SELECT f.id, f.data, f.valor, f.status,
               t.nome AS transportador,
               o.cidade AS cidade_origem,
               d.cidade AS cidade_destino,
               (SELECT COUNT(*) FROM frete_item WHERE id_frete = f.id) AS itens
        FROM frete f
        JOIN transportador t ON t.id = f.id_transportador
        JOIN endereco o ON o.id = f.id_origem
        JOIN endereco d ON d.id = f.id_destino
        ORDER BY f.data DESC, f.id DESC";

$fretes = $pdo->query($sql)->fetchAll();

include '../includes/cabecalho.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Fretes</h1>
    <a href="novo.php" class="btn text-white" style="background-color: #5b3fa0;">+ Gerar novo frete</a>
</div>

<?php if (count($fretes) == 0): ?>
    <div class="alert alert-info">Nenhum frete cadastrado ainda.</div>
<?php else: ?>
    <div class="card">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nº</th>
                    <th>Data</th>
                    <th>Transportador</th>
                    <th>Origem → Destino</th>
                    <th>Itens</th>
                    <th>Valor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fretes as $frete): ?>
                    <tr>
                        <td><?php echo $frete['id']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($frete['data'])); ?></td>
                        <td><?php echo $frete['transportador']; ?></td>
                        <td><?php echo $frete['cidade_origem']; ?> → <?php echo $frete['cidade_destino']; ?></td>
                        <td><?php echo $frete['itens']; ?> produto(s)</td>
                        <td>R$ <?php echo number_format($frete['valor'], 2, ',', '.'); ?></td>
                        <td><?php echo $frete['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include '../includes/rodape.php'; ?>