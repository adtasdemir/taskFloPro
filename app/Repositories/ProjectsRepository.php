<?php

namespace App\Repositories;

use App\Contracts\Repository\ProjectsRepositoryContract;
use App\Models\Project;

class ProjectsRepository extends BaseRepository implements ProjectsRepositoryContract
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function createProject(string $name, ?string $description)
    {
        $Project = new Project();
        $Project->name = $name;
        $Project->description = $description ?? "";
        $Project->save();

        return $Project;
    }

    public function deleteProject(int $id)
    {
        $Project = Project::find($id);
        if ($Project) {
            $Project->delete();
            return true;
        }

        return false;
    }

    public function ListProjects(int $page, int $perPage){
        return  Project::orderBy('id', 'desc')
        ->paginate($perPage, ['*'], 'page', $page);
    }

    public function selectProject(int $id)
    {
        return Project::find($id); 
    }
    
    public function updateProject(int $id, ?string $status, ?string $description, ?string  $name)
    {
        $Project = Project::find($id); 
        
        if (!$Project) {
            return null; 
        }

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

