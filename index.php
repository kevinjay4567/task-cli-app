<?php
require_once 'lib/Action.php';
require_once 'lib/Database.php';
require_once 'lib/task.model.php';
require_once 'lib/utils.php';

$config = require('lib/configs.php');

$db = new Database($config['db_path']);

if ($argc === 1) {
    echo 'Digite un comando de accion: (list, add, delete, update)' . PHP_EOL;
    exit();
}

$action = new Action($db);

match ($argv[1]) {
    "list" => $action->list(),
    "add" => $action->add($argv[2]),
    "delete" => $action->delete($argv[2]),
    "update" => $action->update($argv[2], $argv[3])
};
