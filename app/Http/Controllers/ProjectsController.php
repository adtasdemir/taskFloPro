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


class ProjectsController extends Controller
{
    public ProjectsServiceContract $service;
    /**
     * @var array
     */

    public function __construct(ProjectsServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function createProject(CreateProject $request): array
    {
        return $this->service->createProject($request);
    }

   
    public function deleteProject(DeleteProject $request): array
    {
        return $this->service->deleteProject($request);

    }

     public function listProjects(ListProjects $request): array
    {
        return $this->service->listProjects($request);
    }

    
    public function selectProject(SelectProject $request): array
    {
        return $this->service->selectProject($request);
    }

    public function updateProject(UpdateProject $request): array
    {
        return $this->service->updateProject($request);
    }


    public function listProjectsWeb(ListProjects $request)
    {
        $response = $this->service->listProjects($request);
        return view('dashboard', [
            'projects' => $response['data'],
            'pagination' => $response['extra_data'] ?? []
        ]);
    }

    public function getStatuses()
    {
        try{
            return ResponseHelper::response(true, 'success', ProjectStatus::cases());
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }
}


