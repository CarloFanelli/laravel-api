<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', Rule::unique('projects')->ignore($this->project)],
            'content' => ['nullable'],
            'type_id' => ['nullable', Rule::exists('types', 'id')],
            'cover_image' => ['nullable', 'image'],
            'git_link' => ['nullable'],
            'project_link' => ['nullable'],
            'technologies' => ['nullable', 'exists:technologies,id']

        ];
    }
}
