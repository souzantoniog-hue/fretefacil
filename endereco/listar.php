<?php
require '../config/conexao.php';

$enderecos = $pdo->query("SELECT * FROM endereco ORDER BY cidade")->fetchAll();

include '../includes/cabecalho.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Endereços</h1>
    <a href="form.php" class="btn text-white" style="background-color: #5b3fa0;">+ Novo endereço</a>
</div>

<?php if (count($enderecos) == 0): ?>

    <div class="alert alert-secondary">Nenhum endereço cadastrado ainda.</div>

<?php else: ?>

    <table class="table table-hover bg-white">
        <thead>
            <tr>
                <th>ID</th>
<th>CEP</th>
<th>Endereço</th>
<th>Bairro</th>
<th>Cidade/UF</th>
<th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enderecos as $endereco): ?>
                <tr>
                    <td><?php echo $endereco['id']; ?></td>
<td><?php echo $endereco['cep']; ?></td>
<td><?php echo $endereco['rua']; ?>, <?php echo $endereco['numero']; ?></td>
<td><?php echo $endereco['bairro']; ?></td>
<td><?php echo $endereco['cidade']; ?>/<?php echo $endereco['estado']; ?></td>
                    <td>
                        <a href="form.php?id=<?php echo $endereco['id']; ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="excluir.php" method="post" class="d-inline"
      onsubmit="return confirm('Tem certeza que deseja excluir este endereço?');">
    <input type="hidden" name="id" value="<?php echo $endereco['id']; ?>">
    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
</form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<?php include '../includes/rodape.php'; ?>