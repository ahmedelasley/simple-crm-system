<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'project_id'     => 'required|exists:App\Models\Project,id',
            'description'   => 'required|string',
            'deadline'      => 'required|date',
            'user_id'       => 'required|exists:App\Models\User,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // 
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'          => 'Name',
            'client_id'     => 'Project',
            'description'   => 'Description',
            'deadline'      => 'Deadline',
            'user_id'       => 'User',
        ];
    }
}
