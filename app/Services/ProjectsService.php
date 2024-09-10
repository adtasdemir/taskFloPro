<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\ProjectsRepository;
use App\Contracts\Service\ProjectsServiceContract;
use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class ProjectsService extends BaseService implements ProjectsServiceContract
{
    /**
     * ProjectsService constructor.
     *
     * @param ProjectsRepository $repository
     */
    public function __construct(ProjectsRepository $repository)
    {
        parent::__construct($repository);
    }


    /**
     * Create a new project
     *
     * @param array $request
     * 
     * @return Project
     */
    public function createProject(array $request): Project
    {    
        return $this->repository->createProject(
            $request['name'],
            $request['description'],
        );
    }

    /**
     * Delete a project
     *
     * @param array $request
     * 
     * @return bool
     */
    public function deleteProject(array $request): bool
    {    
        return $this->repository->deleteProject(
            $request['id']
        );
    }

    /**
     * List all projects, with pagination.
     *
     * @param array $request
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listProjects(array $request): LengthAwarePaginator
    {    
        return  $this->repository->ListProjects();
    }

    /**
     * Select a project by id
     *
     * @param array $request
     *
     * @return Project
     */
    public function selectProject(array $request): Project
    {
        return $this->repository->selectProject(
            $request['id']
        );
    }

    /**
     * Update a project
     *
     * @param array $request
     *
     * @return Project
     */
    public function updateProject(array $request): Project
    {
        return $this->repository->updateProject(
            $request['id'],
            $request['status'],
            $request['description'],
            $request['name'],
        );
    }
}

