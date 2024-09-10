<?php

namespace App\Services;

use App\Models\Task;
use App\Services\BaseService;
use App\Repositories\TasksRepository;
use App\Contracts\Service\TasksServieContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TasksService extends BaseService implements TasksServieContract
{
    /**
     * TasksService constructor.
     *
     * @param TasksRepository $repository
     */
    public function __construct(TasksRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create a new task
     *
     * @param array $request
     * 
     * @return \App\Models\Task
     */
    public function createTask(array $request): Task
    {    
        return $this->repository->createTask(
            $request['project_id'],
            $request['name'],
            $request['description'] ?? "",
            $request['status'] ?? "",
        );
    }

    /**
     * Delete task
     * 
     * @param array $request
     * 
     * @return bool
     */
    public function deleteTask(array $request): bool
    {    
        return $this->repository->deleteTask(
            $request['id']
        );
    }

    /**
     * List tasks
     * 
     * @param array $request
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listTasks(array $request): LengthAwarePaginator
    {    
        return $this->repository->listTasks(
            $request['project_id'],
        );
    }

    /**
     * Select a task by id
     * 
     * @param array $request
     * 
     * @return \App\Models\Task
     */
    public function selectTask(array $request): Task
    {
        return $this->repository->selectTask(
            $request['id']
        );
    }

    /**
     * Update a task
     * 
     * @param array $request
     * 
     * @return \App\Models\Task
     */
    public function updateTask(array $request): Task
    {
        return $this->repository->updateTask(
            $request['id'],
            $request['status'],
            $request['description'],
            $request['name'],
        );
    }
}

