<?php
namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ProjectStatus;

class UpdateProject extends FormRequest
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
        $statusList = implode(',', array_map(fn ($status) => $status->value, ProjectStatus::cases()));

        return [
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string','max:255'],
            'id' => ['required', 'integer', 'min:0', 'exists:projects,id'],
            'status' => ['nullable', 'string','max:255','in:'.$statusList],
        ];
    }
    
    /**
     * Custom validation rule to ensure at least one of status, message, or file is provided.
     *
     * @return void
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (is_null($this->input('description')) && is_null($this->input('name')) && is_null($this->input('status'))) {
                $validator->errors()->add('custom', 'At least one of status, name, description, or status must be provided.');
            }
        });
    }

    public function all($keys = null): array
    {
        $data = parent::all($keys);
        $data['id'] = $this->route('id');

        return $data;
    }
}
