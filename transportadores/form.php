<?php
require '../config/conexao.php';

// Começa com tudo vazio (para o cadastro)
 $transportador = ['id' => '', 'nome' => '', 'documento' => '',
                  'telefone' => '', 'placa_veiculo' => ''];

// Se veio um id na URL, busca o produto no banco (para a edição)
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM transportador WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $transportador = $stmt->fetch();
}

include '../includes/cabecalho.php';
?>

<a href="listar.php">← Voltar para transportador</a>
<h1 class="mt-2"><?php echo $transportador['id'] ? 'Editar transportador' : 'Cadastrar transportador'; ?></h1>
<p class="text-muted">Campos com <span class="text-danger">*</span> são obrigatórios.</p>

<form action="salvar.php" method="post" class="card p-4" style="max-width: 700px;">

    <input type="hidden" name="id" value="<?php echo $transportador['id']; ?>">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome ou razão social <span class="text-danger">*</span></label>
        <input type="text" id="nome" name="nome" class="form-control" required value="<?php echo $transportador['nome']; ?>">
    </div>

    <div class="mb-3" style="max-width: 320px;">
        <label for="documento" class="form-label">CPF ou CNPJ <span class="text-danger">*</span></label>
        <input type="text" id="documento" name="documento" class="form-control" required value="<?php echo $transportador['documento']; ?>">
        <div class="form-text">Pessoa física: CPF. Empresa: CNPJ.</div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
            <input type="tel" id="telefone" name="telefone" class="form-control" required placeholder="(00) 00000-0000" value="<?php echo $transportador['telefone']; ?>">
        </div>
        <div class="col-6">
            <label for="placa_veiculo" class="form-label">Placa do veículo</label>
            <input type="text" id="placa_veiculo" name="placa_veiculo" class="form-control" placeholder="ABC1D23" value="<?php echo $transportador['placa_veiculo']; ?>">
        </div>
    </div>
    
  <div class="d-flex justify-content-end gap-2">
        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn text-white" style="background-color: #5b3fa0;">Salvar Trasportador</button>
    </div>
    </form>

<?php include '../includes/rodape.php'; ?>