<?php
require_once 'config/config.php';

// Verifica se está logado
if (!AuthHelper::isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Pega informações do usuário
$userId = AuthHelper::getUserId();
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$userId]);
$usuario = $stmt->fetch();

// Define o título da página
$pageTitle = "Dashboard";
require_once 'includes/header.php';
?>

<div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h2>BeautySalon</h2>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-info">
                <h4><?php echo htmlspecialchars($usuario['nome']); ?></h4>
                <p>Bem-vindo(a)!</p>
            </div>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="dashboard.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="agendamentos.php">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Agendamentos</span>
                    </a>
                </li>
                <li>
                    <a href="servicos.php">
                        <i class="fas fa-cut"></i>
                        <span>Serviços</span>
                    </a>
                </li>
                <li>
                    <a href="perfil.php">
                        <i class="fas fa-user-cog"></i>
                        <span>Meu Perfil</span>
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-footer">
                <a href="logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Conteúdo Principal Restruturado -->
    <main class="main-content">
        <!-- Header do Dashboard -->
        <header class="content-header">
            <div class="header-wrapper">
                <div class="header-title">
                    <h1>Painel de Controle</h1>
                    <p>Gerencie seus agendamentos e serviços</p>
                </div>
                <div class="header-actions">
                    <a href="novo-agendamento.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span>Novo Agendamento</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Container do Conteúdo -->
        <div class="content-container">
            <!-- Cards de Estatísticas -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Próximo Agendamento</h3>
                        <?php
                        try {
                            $stmt = $pdo->prepare("
                                SELECT a.*, s.nome as servico_nome 
                                FROM agendamentos a 
                                JOIN servicos s ON a.servico_id = s.id 
                                WHERE a.usuario_id = ? 
                                AND a.data_agendamento >= CURDATE() 
                                ORDER BY a.data_agendamento ASC, a.hora_agendamento ASC 
                                LIMIT 1
                            ");
                            $stmt->execute([$userId]);
                            $proximo = $stmt->fetch();
                            
                            if ($proximo): ?>
                                <div class="agendamento-info">
                                    <strong><?php echo htmlspecialchars($proximo['servico_nome']); ?></strong>
                                    <span class="agendamento-data">
                                        <i class="far fa-calendar"></i>
                                        <?php echo date('d/m/Y', strtotime($proximo['data_agendamento'])); ?>
                                    </span>
                                    <span class="agendamento-hora">
                                        <i class="far fa-clock"></i>
                                        <?php echo date('H:i', strtotime($proximo['hora_agendamento'])); ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="no-data">
                                    <span>Nenhum agendamento</span>
                                    <a href="novo-agendamento.php" class="btn btn-sm btn-outline">Agendar agora</a>
                                </div>
                            <?php endif;
                        } catch (PDOException $e) {
                            echo "<span class='no-data'>Nenhum agendamento</span>";
                        }
                        ?>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Último Serviço</h3>
                        <?php
                        try {
                            $stmt = $pdo->prepare("
                                SELECT a.*, s.nome as servico_nome 
                                FROM agendamentos a 
                                JOIN servicos s ON a.servico_id = s.id 
                                WHERE a.usuario_id = ? 
                                AND a.data_agendamento < CURDATE() 
                                ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC 
                                LIMIT 1
                            ");
                            $stmt->execute([$userId]);
                            $ultimo = $stmt->fetch();
                            
                            if ($ultimo): ?>
                                <div class="agendamento-info">
                                    <strong><?php echo htmlspecialchars($ultimo['servico_nome']); ?></strong>
                                    <span class="agendamento-data">
                                        <i class="far fa-calendar"></i>
                                        <?php echo date('d/m/Y', strtotime($ultimo['data_agendamento'])); ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="no-data">
                                    <span>Nenhum serviço realizado</span>
                                </div>
                            <?php endif;
                        } catch (PDOException $e) {
                            echo "<span class='no-data'>Nenhum serviço realizado</span>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Histórico de Agendamentos -->
            <div class="content-card">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Histórico de Agendamentos</h2>
                        <p>Seus últimos agendamentos realizados</p>
                    </div>
                    <a href="agendamentos.php" class="btn btn-outline">Ver todos</a>
                </div>
                <div class="card-body">
                    <div class="empty-state">
                        <i class="fas fa-calendar-day"></i>
                        <h3>Nenhum agendamento encontrado</h3>
                        <p>Seus agendamentos aparecerão aqui quando você fizer um</p>
                        <a href="novo-agendamento.php" class="btn btn-primary">Agendar agora</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php require_once 'includes/footer.php'; ?> 