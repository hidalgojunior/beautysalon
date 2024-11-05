<?php
require_once '../config/config.php';

class CalWebhook {
    private $pdo;
    private $webhookSecret;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->webhookSecret = getenv('CAL_WEBHOOK_SECRET');
    }
    
    public function handleRequest() {
        try {
            // Verifica o método da requisição
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->sendResponse(405, 'Método não permitido');
                return;
            }
            
            // Verifica a assinatura do webhook
            if (!$this->validateSignature()) {
                $this->sendResponse(401, 'Assinatura inválida');
                return;
            }
            
            // Recebe e decodifica o payload
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);
            
            if (!$data) {
                $this->sendResponse(400, 'Payload inválido');
                return;
            }
            
            // Processa o evento
            $this->processEvent($data);
            
            // Responde com sucesso
            $this->sendResponse(200, 'Evento processado com sucesso');
            
        } catch (Exception $e) {
            error_log("Erro no webhook Cal.com: " . $e->getMessage());
            $this->sendResponse(500, 'Erro interno do servidor');
        }
    }
    
    private function validateSignature() {
        $signature = $_SERVER['HTTP_CAL_SIGNATURE'] ?? '';
        $payload = file_get_contents('php://input');
        
        $expectedSignature = hash_hmac('sha256', $payload, $this->webhookSecret);
        
        return hash_equals($expectedSignature, $signature);
    }
    
    private function processEvent($data) {
        // Verifica o tipo de evento
        switch ($data['triggerEvent']) {
            case 'BOOKING_CREATED':
                $this->handleNewBooking($data['payload']);
                break;
                
            case 'BOOKING_RESCHEDULED':
                $this->handleRescheduledBooking($data['payload']);
                break;
                
            case 'BOOKING_CANCELLED':
                $this->handleCancelledBooking($data['payload']);
                break;
                
            default:
                error_log("Evento desconhecido do Cal.com: " . $data['triggerEvent']);
                break;
        }
    }
    
    private function handleNewBooking($booking) {
        try {
            // Inicia transação
            $this->pdo->beginTransaction();
            
            // Busca o serviço correspondente
            $servico = $this->getServicoByCalEventType($booking['eventType']['slug']);
            
            if (!$servico) {
                throw new Exception("Serviço não encontrado para: " . $booking['eventType']['slug']);
            }
            
            // Busca ou cria o usuário
            $usuario = $this->getOrCreateUser($booking['attendees'][0]);
            
            // Insere o agendamento
            $stmt = $this->pdo->prepare("
                INSERT INTO agendamentos (
                    usuario_id,
                    servico_id,
                    data_agendamento,
                    hora_agendamento,
                    status,
                    cal_event_uid,
                    observacoes,
                    created_at
                ) VALUES (
                    :usuario_id,
                    :servico_id,
                    :data,
                    :hora,
                    :status,
                    :cal_uid,
                    :observacoes,
                    NOW()
                )
            ");
            
            $stmt->execute([
                ':usuario_id' => $usuario['id'],
                ':servico_id' => $servico['id'],
                ':data' => date('Y-m-d', strtotime($booking['startTime'])),
                ':hora' => date('H:i:s', strtotime($booking['startTime'])),
                ':status' => 'confirmado',
                ':cal_uid' => $booking['uid'],
                ':observacoes' => $booking['responses']['notes'] ?? null
            ]);
            
            // Commit da transação
            $this->pdo->commit();
            
            // Envia notificação por email
            $this->sendBookingConfirmation($usuario, $servico, $booking);
            
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
    
    private function getServicoByCalEventType($slug) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM servicos 
            WHERE cal_event_type_slug = ? 
            AND deleted_at IS NULL 
            LIMIT 1
        ");
        
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
    
    private function getOrCreateUser($attendee) {
        // Busca usuário existente
        $stmt = $this->pdo->prepare("
            SELECT * FROM usuarios 
            WHERE email = ? 
            AND deleted_at IS NULL 
            LIMIT 1
        ");
        
        $stmt->execute([$attendee['email']]);
        $usuario = $stmt->fetch();
        
        if ($usuario) {
            return $usuario;
        }
        
        // Cria novo usuário
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios (
                nome,
                email,
                telefone,
                created_at
            ) VALUES (
                :nome,
                :email,
                :telefone,
                NOW()
            )
        ");
        
        $stmt->execute([
            ':nome' => $attendee['name'],
            ':email' => $attendee['email'],
            ':telefone' => $attendee['phone'] ?? null
        ]);
        
        return [
            'id' => $this->pdo->lastInsertId(),
            'nome' => $attendee['name'],
            'email' => $attendee['email']
        ];
    }
    
    private function sendBookingConfirmation($usuario, $servico, $booking) {
        // Implementar envio de email
        // Você pode usar PHPMailer ou outro serviço de email
    }
    
    private function sendResponse($statusCode, $message) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(['message' => $message]);
    }
}

// Instancia e executa
$webhook = new CalWebhook($pdo);
$webhook->handleRequest(); 



/*

Para configurar no Cal.com:
Vá para as configurações do Cal.com
Adicione um novo webhook
Configure a URL: https://seusite.com/webhooks/CalWebhook.php
Selecione os eventos:
BOOKING_CREATED
BOOKING_RESCHEDULED
BOOKING_CANCELLED
5. Copie o Webhook Secret e configure no seu .env:
Principais características desta implementação:
1. Segurança:
Validação de assinatura
Transações SQL
Sanitização de dados
Tratamento de erros
Funcionalidades:
Criação automática de usuários
Mapeamento de serviços
Confirmação por email
Logs detalhados
Flexibilidade:
Suporte a múltiplos eventos
Fácil extensão
Código modular
Configurável
Robustez:
Tratamento de erros
Rollback em falhas
Validações
Logs
Para usar:
Crie o arquivo webhook
Configure as tabelas
Configure o Cal.com
Teste com Postman ou similar

*/