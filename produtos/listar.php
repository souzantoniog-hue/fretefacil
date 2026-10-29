<?php
require '../config/conexao.php';

$produtos = $pdo->query("SELECT * FROM produto ORDER BY nome")->fetchAll();

include '../includes/cabecalho.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Produtos</h1>
    <a href="form.php" class="btn text-white" style="background-color: #5b3fa0;">+ Novo produto</a>
</div>

<?php if (count($produtos) == 0): ?>

    <div class="alert alert-secondary">Nenhum produto cadastrado ainda.</div>

<?php else: ?>

    <table class="table table-hover bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Peso (kg)</th>
                <th>Medidas (A × L × C, cm)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo $produto['id']; ?></td>
                    <td><?php echo $produto['nome']; ?></td>
                    <td><?php echo $produto['peso']; ?></td>
                    <td><?php echo $produto['altura']; ?> × <?php echo $produto['largura']; ?> × <?php echo $produto['comprimento']; ?></td>
                    <td>
                        <a href="form.php?id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="excluir.php" method="post" class="d-inline"
      onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
    <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
</form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<?php include '../includes/rodape.php'; ?>