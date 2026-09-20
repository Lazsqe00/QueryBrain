<?php

namespace AI;
use Exception;

class GlmClient implements AiClientInterface
{
    private string $apiKey;
    private string $model;
    private string $endpoint;
    private int $maxTokens;
    private float $temperature;

    public function __construct(string $apiKey, string $model, string $endpoint, int $maxTokens, float $temperature) {
        $this->apiKey = trim($apiKey);
        $this->model = $model;
        $this->endpoint =$endpoint;
        $this->maxTokens = $maxTokens;
        $this->temperature = $temperature;
    }
    public function chat(string $prompt, array $history = []): string
    {
        if (empty($this->apiKey))  return "Chưa có API Key.";

        $messages = [
            [
                'role' => 'system',
                'content' => 'Bạn là một trợ lý AI thông minh, thân thiện và hữu ích. Hãy trả lời câu hỏi của người dùng một cách rõ ràng, dễ hiểu và chính xác bằng tiếng Việt.'
            ]
        ];

        foreach ($history as $msg) {
            $messages[] = [
                'role'    => $msg['role'],
                'content' => $msg['content']
            ];
        }

        $messages[] = [
            'role'    => 'user',
            'content' => $prompt
        ];

        return $this->sendRequest($messages);
    }

    private function sendRequest(array $messages): string
    {
        $payload = [
            'model'       => $this->model,
            'messages'    => $messages,
            'max_tokens'  => $this->maxTokens,
            'temperature' => $this->temperature,
            'stream'      => false
        ];

        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ]);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "Lỗi kết nối mạng: " . curl_error($ch);
        }

        $data = json_decode((string)$response, true);

        if (isset($data['error']['message'])) {
            return "Lỗi API: " . $data['error']['message'];
        }

        $data = json_decode($response, true);

        if(!empty($data['choices'][0]['message']['content'])){
            return $data['choices'][0]['message']['content'];
        }
        return "Không nhận được phản hồi từ AI.";
    }
}
