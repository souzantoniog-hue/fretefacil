<?php
require 'config/conexao.php';

$totalProdutos        = $pdo->query("SELECT COUNT(*) FROM produto")->fetchColumn();
$totalEnderecos       = $pdo->query("SELECT COUNT(*) FROM endereco")->fetchColumn();
$totalTransportadores = $pdo->query("SELECT COUNT(*) FROM transportador")->fetchColumn();
$totalFretes          = $pdo->query("SELECT COUNT(*) FROM frete")->fetchColumn();

include 'includes/cabecalho.php';
?>

<h1>Bem-vindo ao FreteFácil</h1>
<p class="text-muted mb-4">Cadastre produtos, endereços e transportadores e gere seus fretes.</p>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Produtos</h5>
            <p class="fs-2"><?php echo $totalProdutos; ?></p>
            <a href="produtos/listar.php" class="btn btn-outline-secondary">Ver produtos</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Endereços</h5>
            <p class="fs-2"><?php echo $totalEnderecos; ?></p>
            <a href="endereco/listar.php" class="btn btn-outline-secondary">Ver endereços</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Transportadores</h5>
            <p class="fs-2"><?php echo $totalTransportadores; ?></p>
            <a href="transportadores/listar.php" class="btn btn-outline-secondary">Ver transportadores</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Fretes</h5>
            <p class="fs-2"><?php echo $totalFretes; ?></p>
            <a href="fretes/listar.php" class="btn btn-outline-secondary">Ver fretes</a>
        </div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>