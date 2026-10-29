<?php
require '../config/conexao.php';

$transportadors = $pdo->query("SELECT * FROM transportador ORDER BY nome")->fetchAll();

include '../includes/cabecalho.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Transportadores</h1>
    <a href="form.php" class="btn text-white" style="background-color: #5b3fa0;">+ Novo Transportador</a>
</div>

<?php if (count($transportadors) == 0): ?>

    <div class="alert alert-secondary">Nenhum transportador cadastrado ainda.</div>

<?php else: ?>

    <table class="table table-hover bg-white">
        <thead>
            <tr>
                <th>ID</th>
<th>Nome</th>
<th>CPF/CNPJ</th>
<th>Telefone</th>
<th>Placa</th>
<th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transportadors as $transportador): ?>
                <tr>
                    <td><?php echo $transportador['id']; ?></td>
<td><?php echo $transportador['id']; ?></td>
<td><?php echo $transportador['nome']; ?></td>
<td><?php echo $transportador['documento']; ?></td>
<td><?php echo $transportador['telefone']; ?></td>
<td><?php echo $transportador['placa_veiculo']; ?></td>
                    <td>
                        <a href="form.php?id=<?php echo $transportador['id']; ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="excluir.php" method="post" class="d-inline"
      onsubmit="return confirm('Tem certeza que deseja excluir este transportador?');">
    <input type="hidden" name="id" value="<?php echo $transportador['id']; ?>">
    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
</form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<?php include '../includes/rodape.php'; ?>