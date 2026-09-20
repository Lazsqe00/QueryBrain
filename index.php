<?php

declare(strict_types=1);
use Controllers\ChatController;
session_start();

require_once __DIR__ . '/autoload.php';
$config = require __DIR__ . '/config/config.php';


$controller = new ChatController($config, 'apifree_ai');
$controller->handle();