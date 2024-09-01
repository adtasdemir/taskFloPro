<?php

namespace App\Repositories;

use App\Contracts\Repository\TasksRepositoryContract;
use App\Models\Task;

class TasksRepository extends BaseRepository implements TasksRepositoryContract
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function createTask(int $project_id, string $name, ?string $description, ?string $status)
    {
        $Task = new Task();
        $Task->project_id = $project_id;
        $Task->name = $name;
        $Task->description = $description ?? "";
        if(!empty($status)){
            $Task->status = $status;
        }
        $Task->save();

        return $Task;
    }


    public function deleteTask(int $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return true;
        }

        return false;
    }

    public function listTasks(int $project_id, int $page, int $perPage){
        return Task::orderBy('id', 'desc')
            ->where('project_id', $project_id)
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function selectTask(int $id)
    {
        return Task::find($id); 
    }
    
    public function updateTask(int $id, ?string $status, ?string $description, ?string  $name, ?int $project_id)
    {
        $Task = Task::find($id);

        if (!$Task) {
            return null; 
        }

        if(!empty($description) || $description == ""){
            $Task->description = $description;
        }

        if(!empty($status)){
            $Task->status = $status;
        }

        if(!empty($name)){
            $Task->name = $name;
        }

        if(!empty($project_id)){
            $Task->project_id = $project_id;
        }

        $Task->save();

        return $Task;
    }
  
}

