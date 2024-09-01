<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'description', 'status'];

    publiC $casts = [
        'status' => TaskStatus::class
   ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
