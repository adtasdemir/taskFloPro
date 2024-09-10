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

    /**
     * TasksController constructor.
     * 
     * @param TasksServieContract $service
     */
    public function __construct(TasksServieContract $service)
    {
        $this->service = $service;
    }

    
    /**
     * Create a new task
     * 
     * @param CreateTask $request
     * 
     * @return array
     */
    public function createTask(CreateTask $request): array
    {
        try{
            $response = $this->service->createTask($request->all());
            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

   
    /**
     * Delete task
     * 
     * @param DeleteTask $request
     * 
     * @return array
     */
    public function deleteTask(DeleteTask $request): array
    {
        try{
            $response = $this->service->deleteTask($request->all());
            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    /**
     * List tasks
     * 
     * @param ListTasks $request
     * 
     * @return array
     */
     public function listTasks(ListTasks $request): array
    {
        try{
            $response = $this->service->listTasks($request->all());
            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    
    public function selectTask(SelectTask $request): array
    {
        try{
            $response = $this->service->selectTask($request->all());
            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    /**
     * Update task
     * 
     * @param UpdateTask $request
     * 
     * @return array
     */
    public function updateTask(UpdateTask $request): array
    {
        try{
            $response = $this->service->updateTask($request->all());
            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }




    /**
     * List tasks for web
     * 
     * @param ListTasks $request
     * 
     * @return array
     */
    public function listTasksWeb(ListTasks $request)
    {
        try{
            $response = $this->service->listTasks($request->all());
            return view('tasks', ['tasks' => $response, 'project_id' => $request->project_id ]);
        }catch(Exception $e){
            return view('error', ['exception' => $e->getMessage() ]);
        }
    }
    

    /**
     * Get all task statuses
     * 
     * @return array
     */
    public function getStatuses()
    {
        try{
            return ResponseHelper::response(true, 'success', TaskStatus::cases());
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }
}
