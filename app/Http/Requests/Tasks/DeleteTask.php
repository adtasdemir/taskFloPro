<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTask extends FormRequest
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
        return [
            'id' => ['required', 'string', 'min:0', 'exists:tasks,id'],
        ];
    }
    
    public function all($keys = null): array
    {
        $data = parent::all($keys);
        $data['id'] = $this->route('id');

        return $data;
    }
}