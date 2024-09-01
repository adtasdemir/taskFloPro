<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Tasks\ListTasks;
use App\Http\Requests\Tasks\CreateTask;
use App\Http\Requests\Tasks\DeleteTask;
use App\Http\Requests\Tasks\SelectTask;
use App\Http\Requests\Tasks\UpdateTask;
use App\Contracts\Service\TasksServieContract;
use App\Enums\TaskStatus;

class TasksController extends Controller
{
    public TasksServieContract $service;
    /**
     * @var array
     */

    public function __construct(TasksServieContract $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function createTask(CreateTask $request): array
    {
        return $this->service->createTask($request);
    }

   
    public function deleteTask(DeleteTask $request): array
    {
        return $this->service->deleteTask($request);

    }

     public function listTasks(ListTasks $request): array
    {
        return $this->service->listTasks($request);
    }

    
    public function selectTask(SelectTask $request): array
    {
        return $this->service->selectTask($request);
    }

    public function updateTask(UpdateTask $request): array
    {
        return $this->service->updateTask($request);
    }

    public function listTasksWeb(ListTasks $request)
    {
        $response = $this->service->listTasks($request);
        return view('tasks', [
            'tasks' => $response['data'],
            'pagination' => $response['extra_data'] ?? [],
            'project_id' => $request['project_id'] ?? []
        ]);
    }
    

    public function getStatuses()
    {
        try{
            return ResponseHelper::response(true, 'success', TaskStatus::cases());
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }
}
