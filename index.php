<?php
$config['db'] = include(__DIR__ . '/config/database.config.php');

spl_autoload_register(function($class) {
    include __DIR__ . '/src/' . $class . '.php';
});

use Controllers\GamesController;

$loader = new GamesController();
$loader();