<?php
// Verificar dependências
if (!isset($conn)) {
    require_once __DIR__ . '/../config/database.php';
}

if (!class_exists('AuthHelper')) {
    require_once __DIR__ . '/../helpers/AuthHelper.php';
}

// Classe para gerenciar serviços
class ServiceManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getActiveServices() {
        try {
            $stmt = $this->conn->prepare("
                SELECT 
                    id,
                    nome,
                    descricao,
                    duracao,
                    preco,
                    (SELECT COUNT(*) FROM agendamentos WHERE servico_id = s.id) as total_agendamentos
                FROM servicos s
                WHERE status = 'ativo'
                ORDER BY nome ASC
            ");
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar serviços: " . $e->getMessage());
            throw new Exception("Não foi possível carregar os serviços");
        }
    }
}

// Funções de renderização
function renderServiceCard($servico) {
    $preco = number_format($servico['preco'], 2, ',', '.');
    $duracao = $servico['duracao'];
    $nome = htmlspecialchars($servico['nome']);
    $descricao = htmlspecialchars($servico['descricao']);
    $id = $servico['id'];
    
    // Gerar o botão de ação
    $actionButton = renderActionButton($id);

    return <<<HTML
    <div class="service-card animate-on-scroll">
        <div class="service-icon">
            <i class="fas fa-spa"></i>
        </div>
        
        <div class="service-header">
            <h3>{$nome}</h3>
            <div class="service-badge">
                <span class="badge badge-primary">{$duracao} min</span>
            </div>
        </div>
        
        <p class="service-description">{$descricao}</p>
        
        <div class="service-info">
            <div class="service-price">
                <i class="fas fa-tag"></i>
                <span>R$ {$preco}</span>
            </div>
            <div class="service-duration">
                <i class="far fa-clock"></i>
                <span>{$duracao} minutos</span>
            </div>
        </div>
        
        <div class="service-action">
            {$actionButton}
        </div>
    </div>
    HTML;
}

function renderActionButton($serviceId) {
    if (AuthHelper::isLoggedIn()) {
        return <<<HTML
        <a href="agendar.php?servico={$serviceId}" class="btn btn-primary">
            <i class="fas fa-calendar-plus"></i>
            Agendar Agora
        </a>
        HTML;
    } else {
        return <<<HTML
        <a href="login.php" class="btn btn-outline">
            <i class="fas fa-sign-in-alt"></i>
            Faça login para agendar
        </a>
        HTML;
    }
}

function renderEmptyState() {
    return <<<HTML
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fas fa-calendar-times"></i>
        </div>
        <h3>Nenhum serviço disponível</h3>
        <p>No momento não há serviços cadastrados ou ativos.</p>
    </div>
    HTML;
}

function renderError($message) {
    return <<<HTML
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <div class="alert-content">
            <h4>Ops! Algo deu errado</h4>
            <p>{$message}</p>
        </div>
    </div>
    HTML;
}

// Renderizar lista de serviços
try {
    $serviceManager = new ServiceManager($conn);
    $servicos = $serviceManager->getActiveServices();

    if (empty($servicos)) {
        echo renderEmptyState();
    } else {
        echo '<div class="services-grid">';
        foreach ($servicos as $servico) {
            echo renderServiceCard($servico);
        }
        echo '</div>';
    }
} catch (Exception $e) {
    echo renderError($e->getMessage());
}
?>