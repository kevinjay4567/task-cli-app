<?php

function readJsonFile()
{
    if (!file_exists('db.json')) echo 'ERROR: No Se encuentra el archivo Json!' . PHP_EOL;

    $file = fopen('db.json', "r");
    $json = '';

    if ($file) {
        while (($line = fgets($file)) !== false) {
            $json = $json . $line;
        }
        fclose($file);
    } else echo "ERROR: Error de lectura de archivo Json!";

    validateJson($json);

    return $json;
}

function writeJsonFile($task)
{
    if (!is_writable('db.json')) throw new Error('No Se encuentra el archivo Json!' . PHP_EOL);

    if (!$file = file_get_contents('db.json')) throw new Error("Error de lectura de archivo Json!" . PHP_EOL);

    $tasks = fromJson($file);
    $task = fromJson($task);
    $tasks[] = $task;

    $file = toJson($tasks);

    file_put_contents('db.json', $file);
}

function deleteTaskInJsonFile($id)
{
    if (!is_writable('db.json')) throw new Error('No Se encuentra el archivo Json!' . PHP_EOL);

    if (!$file = file_get_contents('db.json')) throw new Error("Error de lectura de archivo Json!" . PHP_EOL);

    $tasks = fromJson($file);

    $tasks_result = array_filter($tasks, fn($v) => $v->id !== $id);

    $file = toJson($tasks_result);

    file_put_contents('db.json', $file);
}

function validateJson($json)
{
    if (!json_validate($json)) throw new Error('El archivo Json esta dañado!' . PHP_EOL);
}

function toJson($task)
{
    return json_encode($task);
}

function fromJson($json)
{
    return json_decode($json);
}

function dd($var)
{
    var_dump($var);
    die();
}
