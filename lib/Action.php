<?php

require_once 'lib/task.model.php';

class Action
{
    private array $data;

    public function __construct(private readonly Database $db)
    {
        $this->data = json_decode($db->all());
    }

    public function list()
    {

        if (count($this->data) === 0) echo 'No hay tareas guardadas' . PHP_EOL;

        foreach ($this->data as $value) {
            print_r('ID: ' . $value->id . ', Task: ' . $value->title . PHP_EOL);
        };
    }

    public function add($title)
    {
        $new_task = new Task();
        $new_task->id = uniqid(rand() . "PHP__", true);
        $new_task->title = $title;
        $new_task->description = "";
        $new_task->status = "todo";
        $new_task->createdAt = date('d-m-Y');
        $new_task->updatedAt = date('d-m-Y');

        $this->data[] = $new_task;

        $file = json_encode($this->data);

        $this->db->writeFile($file);

        echo 'Tarea creada correctamente' . PHP_EOL;
    }

    public function delete($id)
    {
        $tasks_result = array_filter($this->data, fn($v) => $v->id !== $id);

        $file = json_encode($tasks_result);

        $this->db->writeFile($file);

        echo 'Tarea eliminada correctamente' . PHP_EOL;
    }

    public function update($id, $description)
    {
        $tasks_result = array_map(fn($v) => $v->id === $id ? $this->updateTask($v, $description) : $v, $this->data);

        $file = json_encode($tasks_result);

        $this->db->writeFile($file);

        echo 'Tarea actualizada correctamente' . PHP_EOL;
    }

    public function updateTask($task, $description)
    {
        $task->description = $description;
        $task->updateAt = date('d-m-Y');

        return $task;
    }
}
