<?php

namespace App\Services;

use Exception;
use App\Services\BaseService;
use App\Helpers\ResponseHelper;
use App\Repositories\ProjectsRepository;
use App\Http\Requests\Projects\ListProjects;
use App\Http\Requests\Projects\CreateProject;
use App\Http\Requests\Projects\DeleteProject;
use App\Http\Requests\Projects\SelectProject;
use App\Http\Requests\Projects\UpdateProject;
use App\Contracts\Service\ProjectsServiceContract;


class ProjectsService extends BaseService implements ProjectsServiceContract
{
    public function __construct(ProjectsRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createProject(CreateProject $request): array
    {    
        try{
            $response = $this->repository->createProject(
                $request->name,
                $request->description,
            );

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    public function deleteProject(DeleteProject $request): array
    {    
        try{
            $response = $this->repository->deleteProject(
                $request->id
            );

            return ResponseHelper::response($response, $response ? 'success' : 'failed');
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    public function listProjects(ListProjects $request): array
    {    
        try{
            $response = $this->repository->ListProjects(
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

    public function selectProject(SelectProject $request): array
    {
        try{
            $response = $this->repository->selectProject(
                $request->id
            );

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }

    public function updateProject(UpdateProject $request): array
    {
          try{
            $response = $this->repository->updateProject(
                $request->id,
                $request->status,
                $request->description,
                $request->name,
            );

            return ResponseHelper::response(true, 'success', $response);
        }catch(Exception $e){
            return ResponseHelper::response(false, $e->getMessage());
        }
    }
}

