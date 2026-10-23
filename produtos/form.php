<?php include '../includes/cabecalho.php'; ?>

<a href="listar.php">← Voltar para produtos</a>
<h1 class="mt-2">Cadastrar produto</h1>
<p class="text-muted">Campos com <span class="text-danger">*</span> são obrigatórios.</p>

<form action="salvar.php" method="post" class="card p-4" style="max-width: 700px;">

    <div class="mb-3">
        <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea id="descricao" name="descricao" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3" style="max-width: 200px;">
        <label for="peso" class="form-label">Peso (kg) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" id="peso" name="peso" class="form-control" required>
    </div>

    <p class="form-label mb-1">Medidas (cm)</p>
    <div class="row mb-4">
        <div class="col">
            <label for="altura" class="form-label text-muted">Altura</label>
            <input type="number" step="0.01" id="altura" name="altura" class="form-control">
        </div>
        <div class="col">
            <label for="largura" class="form-label text-muted">Largura</label>
            <input type="number" step="0.01" id="largura" name="largura" class="form-control">
        </div>
        <div class="col">
            <label for="comprimento" class="form-label text-muted">Comprimento</label>
            <input type="number" step="0.01" id="comprimento" name="comprimento" class="form-control">
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn text-white" style="background-color: #5b3fa0;">Salvar produto</button>
    </div>

</form>

<?php include '../includes/rodape.php'; ?>