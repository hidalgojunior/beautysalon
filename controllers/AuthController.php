<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'setup_admin':
            setupAdmin();
            break;
        case 'login':
            login();
            break;
        case 'register':
            register();
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Ação inválida']);
            break;
    }
}

function setupAdmin() {
    global $pdo;
    
    try {
        // Verifica se já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute(['flutter.marilia@gmail.com']);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'Administrador já está configurado']);
            return;
        }

        // Insere o admin
        $stmt = $pdo->prepare(
            "INSERT INTO usuarios (nome, email, telefone, senha, created_at) 
             VALUES (?, ?, ?, ?, NOW())"
        );
        
        $senha = password_hash('jr34139251', PASSWORD_DEFAULT);
        
        $stmt->execute([
            'Arnaldo Martins Hidalgo Junior',
            'flutter.marilia@gmail.com',
            '14998168273',
            $senha
        ]);

        echo json_encode(['success' => true, 'message' => 'Administrador configurado com sucesso']);
        
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Erro ao configurar administrador']);
    }
}

function login() {
    global $pdo;
    
    try {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'] ?? '';

        // Validações básicas
        if (empty($email) || empty($senha)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Preencha todos os campos']);
            return;
        }

        // Busca o usuário
        $stmt = $pdo->prepare("
            SELECT id, nome, email, senha 
            FROM usuarios 
            WHERE email = ? 
            AND deleted_at IS NULL
        ");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        // Verifica se encontrou o usuário e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Verifica se a sessão já está ativa antes de iniciá-la
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            $_SESSION['user_email'] = $usuario['email'];

            header('Content-Type: application/json');
            echo json_encode([
                'success' => true, 
                'redirect' => 'dashboard.php',
                'message' => 'Login realizado com sucesso!'
            ]);
            
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Email ou senha incorretos']);
        }

    } catch (Exception $e) {
        error_log($e->getMessage());
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Erro ao realizar login']);
    }
}

function register() {
    global $pdo;
    
    try {
        // Recebe e sanitiza os dados
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = $_POST['senha'] ?? '';
        $confirmarSenha = $_POST['confirmar_senha'] ?? '';

        // Validações
        if (empty($nome) || empty($email) || empty($telefone) || empty($senha)) {
            echo json_encode(['success' => false, 'message' => 'Preencha todos os campos']);
            return;
        }

        if ($senha !== $confirmarSenha) {
            echo json_encode(['success' => false, 'message' => 'As senhas não conferem']);
            return;
        }

        // Verifica se email já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND deleted_at IS NULL");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'Este email já está cadastrado']);
            return;
        }

        // Insere o usuário
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nome, email, telefone, senha, created_at) 
            VALUES (?, ?, ?, ?, NOW())
        ");

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt->execute([$nome, $email, $telefone, $senhaHash]);

        echo json_encode([
            'success' => true,
            'message' => 'Cadastro realizado com sucesso!',
            'redirect' => 'login.php'
        ]);

    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Erro ao realizar cadastro']);
    }
}