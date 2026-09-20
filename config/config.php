<?php 
    return [
        'apifree_ai' => [
            'provider'    => 'glm',
            'api_key'     => 'NONE', 
            'model'       => 'zai-org/glm-4.7',
            'endpoint'    => 'https://api.apifree.ai/v1/chat/completions',
            'max_tokens'  => 2048,
            'temperature' => 0.7,
        ]
    ];
?>