<?php

namespace App\Repositories;

use App\Models\Project;
use App\Contracts\Repository\ProjectsRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectsRepository extends BaseRepository implements ProjectsRepositoryContract
{
    /**
     * Create a new instance of ProjectsRepository
     *
     * @param  \App\Models\Project  $model
     * @return void
     */
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    /**
     * Create a new project
     *
     * @param string $name
     * @param string|null $description
     * @return Project
     */
    public function createProject(string $name, ?string $description): Project
    {
        return $this->create([
            'name' => $name,
            'description' => $description ?? ""
        ]);
    }

    /**
     * Delete a project
     *
     * @param int $id
     * @return bool
     */
    public function deleteProject(int $id): bool
    {
        return $this->query()->find($id)->delete();
    }

    /**
     * List all projects, with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function ListProjects(): LengthAwarePaginator
    {
        return $this->query()->paginate();
    }

    /**
     * Select a project by id
     *
     * @param int $id
     * @return Project
     */
    public function selectProject(int $id): Project
    {
        return $this->query()->find($id); 
    }
    
    /**
     * Update a project
     * 
     * @param int $id
     * @param string|null $status
     * @param string|null $description
     * @param string|null $name
     * 
     * @return Project
     */
    public function updateProject(int $id, ?string $status, ?string $description, ?string  $name): Project
    {
        $Project = $this->query()->find($id); 

        if(!empty($description) || $description == ""){
            $Project->description = $description;
        }

        if(!empty($status)){
            $Project->status = $status;
        }

        if(!empty($name)){
            $Project->name = $name;
        }

        $Project->save();

        return $Project;
    }

}

