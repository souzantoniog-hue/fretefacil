<?php
require '../config/conexao.php';

// Se escolheu uma data, usa ela. Se não, usa a data de hoje.
$data = $_GET['data'] ?? date('Y-m-d');

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

$total = 0;

include '../includes/cabecalho.php';
?>

<h1>Relatório de fretes do dia</h1>
<p class="text-muted">Escolha uma data para ver os fretes daquele dia e baixar o relatório.</p>

<form method="get" class="card p-4 mb-4">
    <div class="row align-items-end">
        <div class="col-md-4">
            <label for="data" class="form-label">Data</label>
            <input type="date" id="data" name="data" class="form-control" value="<?php echo $data; ?>">
        </div>
        <div class="col-md-8">
            <button type="submit" class="btn btn-outline-secondary">Ver fretes</button>
            <a href="baixar.php?data=<?php echo $data; ?>" class="btn text-white" style="background-color: #5b3fa0;">Baixar relatório (CSV)</a>
        </div>
    </div>
</form>

<h2 class="h5">Fretes de <?php echo date('d/m/Y', strtotime($data)); ?></h2>

<?php if (count($fretes) == 0): ?>
    <div class="alert alert-info">Nenhum frete nesta data.</div>
<?php else: ?>
    <div class="card">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nº</th>
                    <th>Transportador</th>
                    <th>Origem → Destino</th>
                    <th>Itens</th>
                    <th>Valor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fretes as $frete): ?>
                    <?php $total = $total + $frete['valor']; ?>
                    <tr>
                        <td><?php echo $frete['id']; ?></td>
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
    <p class="mt-3 fw-bold">
        <?php echo count($fretes); ?> frete(s) · Total: R$ <?php echo number_format($total, 2, ',', '.'); ?>
    </p>
<?php endif; ?>

<?php include '../includes/rodape.php'; ?>