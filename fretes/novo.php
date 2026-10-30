<?php
require '../config/conexao.php';

// Busca as opções dos selects no banco
$transportadores = $pdo->query("SELECT id, nome FROM transportador ORDER BY nome")->fetchAll();
$enderecos = $pdo->query("SELECT id, rua, numero, cidade, estado FROM endereco ORDER BY cidade")->fetchAll();
$produtos = $pdo->query("SELECT id, nome FROM produto ORDER BY nome")->fetchAll();

include '../includes/cabecalho.php';
?>

<a href="listar.php">← Voltar para fretes</a>
<h1 class="mt-2">Gerar novo frete</h1>
<p class="text-muted">Campos com <span class="text-danger">*</span> são obrigatórios.</p>

<form action="salvar.php" method="post" style="max-width: 900px;">

    <!-- PARTE 1: dados do frete -->
    <div class="card p-4 mb-3">
        <h5 class="mb-3">1. Dados do frete</h5>

        <div class="mb-3">
            <label for="id_transportador" class="form-label">Transportador <span class="text-danger">*</span></label>
            <select id="id_transportador" name="id_transportador" class="form-select" required>
                <option value="">Selecione o transportador</option>
                <?php foreach ($transportadores as $t): ?>
                    <option value="<?php echo $t['id']; ?>"><?php echo $t['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_origem" class="form-label">Origem <span class="text-danger">*</span></label>
                <select id="id_origem" name="id_origem" class="form-select" required>
                    <option value="">Selecione o endereço de coleta</option>
                    <?php foreach ($enderecos as $e): ?>
                        <option value="<?php echo $e['id']; ?>">
                            <?php echo $e['rua'] . ', ' . $e['numero'] . ' — ' . $e['cidade'] . '/' . $e['estado']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="id_destino" class="form-label">Destino <span class="text-danger">*</span></label>
                <select id="id_destino" name="id_destino" class="form-select" required>
                    <option value="">Selecione o endereço de entrega</option>
                    <?php foreach ($enderecos as $e): ?>
                        <option value="<?php echo $e['id']; ?>">
                            <?php echo $e['rua'] . ', ' . $e['numero'] . ' — ' . $e['cidade'] . '/' . $e['estado']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div> 
               <div class="row">
            <div class="col-md-4">
                <label for="data" class="form-label">Data <span class="text-danger">*</span></label>
                <input type="date" id="data" name="data" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-md-4">
                <label for="valor" class="form-label">Valor (R$) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="valor" name="valor" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select id="status" name="status" class="form-select" required>
                    <option>Aguardando coleta</option>
                    <option>Em andamento</option>
                    <option>Entregue</option>
                </select>
            </div>
        </div>
    </div>         
    <!-- PARTE 2: produtos do frete -->
    <div class="card p-4 mb-3">
        <h5>2. Produtos do frete</h5>
        <p class="text-muted small">Um frete pode levar vários produtos.</p>

        <div id="lista-produtos">
            <div class="row g-2 align-items-end mb-2 linha-produto">
                <div class="col-md-7">
                    <label class="form-label">Produto</label>
                    <select name="produtos[]" class="form-select" required>
                        <option value="">Selecione o produto</option>
                        <?php foreach ($produtos as $p): ?>
                            <option value="<?php echo $p['id']; ?>"><?php echo $p['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Quantidade</label>
                    <input type="number" name="quantidades[]" class="form-control" min="1" value="1" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger w-100 btn-remover">Remover</button>
                </div>
            </div>
        </div>

        <button type="button" id="btn-adicionar" class="btn btn-outline-secondary mt-2">+ Adicionar produto</button>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn text-white" style="background-color: #5b3fa0;">Salvar frete</button>
    </div>

</form>
<script src="/fretefacil/assets/js/frete.js"></script>

<?php include '../includes/rodape.php'; ?>