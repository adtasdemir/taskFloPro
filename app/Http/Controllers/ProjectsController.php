<?php

namespace App\Http\Controllers;

use Exception;
use App\Enums\ProjectStatus;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Projects\ListProjects;
use App\Http\Requests\Projects\CreateProject;
use App\Http\Requests\Projects\DeleteProject;
use App\Http\Requests\Projects\SelectProject;
use App\Http\Requests\Projects\UpdateProject;
use App\Contracts\Service\ProjectsServiceContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class ProjectsController extends Controller
{
    public ProjectsServiceContract $service;
    /**
     * @var array
     */

    /**
     * ProjectsController constructor.
     *
     * @param ProjectsServiceContract $service
     */
    public function __construct(ProjectsServiceContract $service)
    {
        $this->service = $service;
    }

  
    /**
     * Create a new project
     *
     * @param CreateProject $request
     * @return array
     */
    public function createProject(CreateProject $request): array
    {
        try{
            $response = $this->service->createProject($request->all());
            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

   
    /**
     * Delete a project
     *
     * @param DeleteProject $request
     * @return array
     */
    public function deleteProject(DeleteProject $request): array
    {
        try{
            $response = $this->service->deleteProject($request->all());
            return ResponseHelper::response($response, $response ? 'success' : 'failed');
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }

       
    }

    /**
     * List all projects, with pagination.
     *
     * @param ListProjects $request
     * @return array
     */
     public function listProjects(ListProjects $request): array
    {
        try{
            $response = $this->service->listProjects($request->all());

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    
    /**
     * Select a project by id
     *
     * @param SelectProject $request
     * @return array
     */
    public function selectProject(SelectProject $request): array
    {
        try{
            $response   = $this->service->selectProject($request->all());

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    /**
     * Update a project
     * 
     * @param UpdateProject $request
     * 
     * @return array
     */
    public function updateProject(UpdateProject $request): array
    {
        try{
            $response = $this->service->updateProject($request->all());
            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }


    /**
     * List all projects, with pagination.
     * 
     * @param ListProjects $request
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function listProjectsWeb(ListProjects $request)
    {
        try{
            $response = $this->service->listProjects($request->all());
            return view('dashboard', ['projects' => $response ]);
        }catch(Exception $e){
            return view('error', ['exception' => $e->getMessage() ]);
        }
    }

    /**
     * Get all project statuses
     * 
     * @return array
     */
    public function getStatuses()
    {
        try{
            return ResponseHelper::response(true, 'success', ProjectStatus::cases());
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }
}

