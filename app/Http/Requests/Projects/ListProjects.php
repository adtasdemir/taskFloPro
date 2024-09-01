<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ListProjects extends FormRequest
{
    const PER_PAGE = 25;
    const MAX_LIMIT_OF_PER_PAGE = 100;

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
            'per_page' => ['nullable', 'integer', 'min:1', 'max:' . self::MAX_LIMIT_OF_PER_PAGE],
            'page' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'per_page' => $this->input('per_page') ?? self::PER_PAGE,
            'page' => $this->input('page') ?? 1,
        ]);
    }

    public function all($keys = null): array
    {
        $data = parent::all($keys);
        if(empty($data['page'])){
            $data['page'] = $this->route('page') ?? "";
        }
        if(empty($data['per_page'])){
            $data['per_page'] = $this->route('per_page') ?? "";
        }
        return $data;
    }
}