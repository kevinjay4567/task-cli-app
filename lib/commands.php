<?php

function getAllTasks($json)
{
    $tasks = fromJson($json);

    if (count($tasks) === 0) echo 'No hay tareas guardadas!' . PHP_EOL;

    foreach ($tasks as $value) {
        print_r('ID: ' . $value->id . ", Task: " . $value->title . PHP_EOL);
    };
}

function addTask($title): void
{
    $new_task = new Task();
    $new_task->id = uniqid(rand() . "PHP__", true);
    $new_task->title = $title;
    $new_task->description = "";
    $new_task->status = "todo";
    $new_task->createdAt = date('d-m-Y');
    $new_task->updatedAt = date('d-m-Y');

    writeJsonFile(toJson($new_task));

    echo 'Tarea agregada correctamente!' . PHP_EOL;
}

function deleteTask($id)
{
    deleteTaskInJsonFile($id);

    echo "Tarea eliminada correctamente!" . PHP_EOL;
}

function notSuportedCommand()
{
    echo "ERROR: Comando no sorportado!" . PHP_EOL;
}
