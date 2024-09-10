<?php
namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;


class UpdateTask extends FormRequest
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
            'description' => ['nullable','string', 'max:255'], 
            'status' => ['nullable', 'string','max:255','in:'.$statusList],
            'id' => ['required', 'string', 'min:0', 'exists:tasks,id'],
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
                $validator->errors()->add('custom', 'At least one of name, description, or status must be provided.');
            }
        });
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
