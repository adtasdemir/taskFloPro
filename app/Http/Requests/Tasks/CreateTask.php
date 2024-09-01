<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $statusList = implode(',', array_map(fn ($status) => $status->value, TaskStatus::cases()));

        return [
            'name' => ['nullable', 'string', 'max:255'],
            'project_id' => ['required', 'integer', 'min:0', 'exists:projects,id'],
            'description' => ['nullable','string', 'max:255'], 
            'status' => ['nullable', 'string','max:255','in:'.$statusList],
        ];
    }
}
