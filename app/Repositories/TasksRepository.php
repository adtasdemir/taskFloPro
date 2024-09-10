<?php

namespace App\Repositories;

use App\Models\Task;
use App\Contracts\Repository\TasksRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TasksRepository extends BaseRepository implements TasksRepositoryContract
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * Create a new task
     *
     * @param int $project_id
     * @param string $name
     * @param string|null $description
     * @param string|null $status
     *
     * @return \App\Models\Task
     */
    public function createTask(int $project_id, string $name, ?string $description, ?string $status): Task
    {
        $data = [
            'project_id' => $project_id,
            'name' => $name,
            'description' => $description ?? ""
        ];
        if(!empty($status)){
            $data['status'] = $status;
        }
        return $this->create($data);
    }


    /**
     * Delete a task
     *
     * @param int $id
     *
     * @return bool
     */
    public function deleteTask(int $id): bool
    {
        return $this->query()->find($id)->delete();
    }

    /**
     * List tasks
     * 
     * @param int $project_id
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listTasks(int $project_id): LengthAwarePaginator
    {
        return $this->query()->where('project_id', $project_id)->paginate();
    }

    /**
     * Select a task by id
     * 
     * @param int $id
     * 
     * @return \App\Models\Task
     */
    public function selectTask(int $id): Task
    {
        return $this->query()->find($id); 
    }
    
    /**
     * Update a task
     * 
     * @param int $id
     * @param string|null $status
     * @param string|null $description
     * @param string|null $name
     * @param int|null $project_id
     * 
     * @return \App\Models\Task
     */
    public function updateTask(int $id, ?string $status, ?string $description, ?string  $name)
    {
        $Task = $this->query()->find($id);

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

        $Task->save();

        return $Task;
    }
  
}

