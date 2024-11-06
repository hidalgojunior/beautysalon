<?php
require_once __DIR__ . '/init.php';
require_once ROOT_PATH . '/config/Database.php';
require_once ROOT_PATH . '/views/templates/header.php';
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Teste de Conexão</h4>
    </div>
    <div class="card-body">
        <?php
        try {
            $db = Database::getInstance()->getConnection();
            echo '<div class="alert alert-success">
                    ✅ Conexão com o banco de dados estabelecida com sucesso!
                  </div>';
            
            $tables = array('usuarios', 'categorias', 'locais', 'itens', 'movimentacoes', 'manutencoes');
            
            echo '<ul class="list-group mt-3">';
            foreach ($tables as $table) {
                $query = $db->query("SHOW TABLES LIKE '$table'");
                if ($query->rowCount() > 0) {
                    echo '<li class="list-group-item text-success">✅ Tabela '.$table.' encontrada</li>';
                } else {
                    echo '<li class="list-group-item text-danger">❌ Tabela '.$table.' não encontrada</li>';
                }
            }
            echo '</ul>';

        } catch(PDOException $e) {
            echo '<div class="alert alert-danger">
                    ❌ Erro na conexão: ' . $e->getMessage() . '
                  </div>';
        }
        ?>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/templates/footer.php'; ?> 