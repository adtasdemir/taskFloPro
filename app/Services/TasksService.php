<?php

namespace App\Services;

use Exception;
use App\Services\BaseService;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Tasks\ListTasks;
use App\Repositories\TasksRepository;
use App\Http\Requests\Tasks\CreateTask;
use App\Http\Requests\Tasks\DeleteTask;
use App\Http\Requests\Tasks\SelectTask;
use App\Http\Requests\Tasks\UpdateTask;
use App\Contracts\Service\TasksServieContract;

class TasksService extends BaseService implements TasksServieContract
{
    public function __construct(TasksRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createTask(CreateTask $request): array
    {    
        try{
            $response = $this->repository->createTask(
                $request->project_id,
                $request->name,
                $request->description ?? "",
                $request->status ?? "",
            );

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    public function deleteTask(DeleteTask $request): array
    {    
        try{
            $response = $this->repository->deleteTask(
                $request->id
            );

            return ResponseHelper::response($response, $response ? 'success' : 'failed');
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    public function listTasks(ListTasks $request): array
    {    
        try{
            $response = $this->repository->listTasks(
                $request->project_id,
                $request->page,
                $request->per_page,
            );

            $extraData = [
                'per_page' => $response->perPage(),   
                'current_page' => $response->currentPage(),  
                'last_page' => $response->lastPage()
            ];

            return ResponseHelper::response(true, 'success', $response->items(), $extraData);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    public function selectTask(SelectTask $request): array
    {
        try{
            $response = $this->repository->selectTask(
                $request->id
            );

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    public function updateTask(UpdateTask $request): array
    {
          try{
            $response = $this->repository->updateTask(
                $request->id,
                $request->status,
                $request->description,
                $request->name,
                $request->project_id
            );

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }
}

