<?php
require '../config/conexao.php';

// Começa com tudo vazio (para o cadastro)
$endereco = ['id' => '', 'cep' => '', 'rua' => '', 'numero' => '',
            'complemento' => '', 'bairro' => '', 'cidade' => '', 'estado' => ''];

// Se veio um id na URL, busca o produto no banco (para a edição)
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM endereco WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $endereco = $stmt->fetch();
}

include '../includes/cabecalho.php';
?>

<a href="listar.php">← Voltar para endereco</a>
<h1 class="mt-2"><?php echo $endereco['id'] ? 'Editar endereco' : 'Cadastrar endereco'; ?></h1>
<p class="text-muted">Campos com <span class="text-danger">*</span> são obrigatórios.</p>

<form action="salvar.php" method="post" class="card p-4" style="max-width: 700px;">

    <input type="hidden" name="id" value="<?php echo $endereco['id']; ?>">

    <div class="mb-3" style="max-width: 220px;">
        <label for="cep" ...

        <div class="mb-3" style="max-width: 220px;">
        <label for="cep" class="form-label">CEP <span class="text-danger">*</span></label>
        <input type="text" id="cep" name="cep" class="form-control" required placeholder="00000-000" value="<?php echo $endereco['cep']; ?>">
    </div>

    <div class="row mb-3">
        <div class="col-9">
            <label for="rua" class="form-label">Rua <span class="text-danger">*</span></label>
            <input type="text" id="rua" name="rua" class="form-control" required value="<?php echo $endereco['rua']; ?>">
        </div>
        <div class="col-3">
            <label for="numero" class="form-label">Número <span class="text-danger">*</span></label>
            <input type="text" id="numero" name="numero" class="form-control" required value="<?php echo $endereco['numero']; ?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="complemento" class="form-label">Complemento</label>
        <input type="text" id="complemento" name="complemento" class="form-control" value="<?php echo $endereco['complemento']; ?>">
    </div>

    <div class="mb-3">
        <label for="bairro" class="form-label">Bairro <span class="text-danger">*</span></label>
        <input type="text" id="bairro" name="bairro" class="form-control" required value="<?php echo $endereco['bairro']; ?>">
    </div>

    <div class="row mb-4">
        <div class="col-9">
            <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
            <input type="text" id="cidade" name="cidade" class="form-control" required value="<?php echo $endereco['cidade']; ?>">
        </div>
        <div class="col-3">
            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
            <input type="text" id="estado" name="estado" class="form-control" required maxlength="2" placeholder="PR" value="<?php echo $endereco['estado']; ?>">
        </div>
    </div>
  <div class="d-flex justify-content-end gap-2">
        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn text-white" style="background-color: #5b3fa0;">Salvar endereço</button>
    </div>
    </form>

<?php include '../includes/rodape.php'; ?>