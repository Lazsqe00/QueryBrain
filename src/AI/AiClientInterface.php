<?php

namespace AI;

interface AiClientInterface
{
    public function chat(string $prompt, array $history = []): string;
}