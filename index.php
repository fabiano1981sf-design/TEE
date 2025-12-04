<?php 
/**
 * ARQUIVO: index.php
 * DESCRIÇÃO: Dashboard principal do sistema.
 */
require_once 'auth.php'; // Protege a página e inicia a sessão
include 'header.php';
include 'sidebar.php';
require_once 'conexao.php'; // Garante a conexão com o banco

$status = $_GET['status'] ?? '';
$mensagem = $_GET['msg'] ?? '';

// Função auxiliar para exibir o alerta (mantida por segurança)
if (!function_exists('display_alert')) {
    function display_alert($status, $msg) {
        if (!empty($status) && !empty($msg)) {
            $class = $status === 'sucesso' ? 'alert-success' : 'alert-danger';
            echo '<div class="alert ' . $class . ' alert-dismissible fade show" role="alert">';
            echo htmlspecialchars($msg);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }
}

// =========================================================================
// BUSCA DOS DADOS REAIS PARA OS CARDS (Lógica simplificada ou temporariamente desativada)
// =========================================================================

// Para evitar o erro, vamos usar 0 como valor temporário (fictício, mas seguro)
$tarefas_pendentes = 0; // Você pode recolocar a lógica SQL aqui depois.
$membros_ativos = 0;
$tarefas_concluidas_mes = 0;
$atividades_recentes = []; 
// =========================================================================
?>

<div id="main-content">
    <?php display_alert($status, $mensagem); ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dashboard <i class="bi bi-speedometer2"></i></h1>
        
        <?php if ($_SESSION['usuario_perfil'] === 'admin'): ?>
            <a href="perfil.php?id=novo" class="btn btn-primary shadow-sm">
                <i class="bi bi-person-plus-fill me-1"></i> Cadastrar Usuário
            </a>
        <?php endif; ?>
        
    </div>
    
    <div class="row">
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tarefas Pendentes (Atrasado/Andamento)</h5>
                    <p class="card-text display-4"><?= $tarefas_pendentes ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Membros Ativos</h5>
                    <p class="card-text display-4"><?= $membros_ativos ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Concluídas Este Mês (<?= date('M/y') ?>)</h5>
                    <p class="card-text display-4"><?= $tarefas_concluidas_mes ?></p>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="card shadow-sm">
        <div class="card-header">
            Últimas Tarefas Atualizadas
        </div>
        <ul class="list-group list-group-flush">
            <?php if (empty($atividades_recentes)): ?>
                <li class="list-group-item text-muted">Nenhuma atividade recente registrada (dados fictícios ou erro de conexão).</li>
            <?php else: ?>
                <?php endif; ?>
        </ul>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>