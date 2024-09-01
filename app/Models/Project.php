<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ProjectStatus;

class Project extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'status'
    ];
    
    publiC $casts = [
        'status' => ProjectStatus::class
    ];
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
