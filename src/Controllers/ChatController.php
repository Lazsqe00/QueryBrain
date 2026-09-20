<?php

namespace Controllers;

use AI\GlmClient;
use AI\AiClientInterface;
use Exception;

class ChatController
{
    private array $config;
    private AiClientInterface $aiClient;

    public function __construct(array $config, string $key)
    {
        $this->config = $config;
        $aiConfig = $config[$key];
        $this->aiClient = new GlmClient(
            $aiConfig['api_key'],
            $aiConfig['model'] ,
            $aiConfig['endpoint'],
            $aiConfig['max_tokens'],
            $aiConfig['temperature'],
        );
    }

    public function handle(): void
    {
        $action = $_GET['action'] ?? '';

        if ($action === 'new_chat') {
            $_SESSION['chat_history'] = [];
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question'])) {
            $this->handleSendMessage();
            return;
        }
        $this->renderView();
    }
    private function handleSendMessage(): void
    {
        $question = $_POST['question'];
        $now = date('M j, Y g:i A');

        $_SESSION['chat_history'][] = [
            'role'    => 'user',
            'content' => $question,
            'time'    => $now
        ];

        try {
            $answer = $this->aiClient->chat($question, $_SESSION['chat_history']);

            $_SESSION['chat_history'][] = [
                'role'    => 'assistant',
                'content' => $answer,
                'time'    => date('M j, Y g:i A')
            ];
        } 
        catch (Exception $e) {

            $_SESSION['chat_history'][] = [
                'role'    => 'assistant',
                'content' => 'Lỗi kết nối rầu' . $e->getMessage(),
                'time'    => date('M j, Y g:i A'),
            ];
        }

        $isAjax = isset($_POST['ajax']) && $_POST['ajax'] === '1';

        if ($isAjax) {
            $messages = $_SESSION['chat_history'];
            require dirname(__DIR__, 2) . '/views/components/chat_area.php';
            exit;
        }

        header('Location: index.php');
        exit;
    }

    private function renderView(): void
    {
        $messages = $_SESSION['chat_history'] ?? [];

        $baseDir = dirname(__DIR__, 2);
        require $baseDir . '/views/layout/header.php';
        require $baseDir . '/views/components/chat_area.php';
        require $baseDir . '/views/components/sidebar.php';
        require $baseDir . '/views/components/nav_rail.php';
        require $baseDir . '/views/layout/footer.php';
    }
}
