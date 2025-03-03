<?php
require_once 'lib/task.model.php';
require_once 'lib/utils.php';
require_once 'lib/commands.php';

$config = require('lib/configs.php');

if ($argc === 1) {
    echo 'Digite un comando de accion: (list, add, delete, update)' . PHP_EOL;
    exit();
}

$json_data = readJsonFile($config['db_path']);

match ($argv[1]) {
    "list" => getAllTasks($json_data),
    "add" => addTask($argv[2]),
    "delete" => deleteTask($argv[2]),
    default => notSuportedCommand()
};
