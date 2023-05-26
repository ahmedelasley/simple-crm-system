<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name'         => 'required|string|unique:clients|max:255',
            'description'   => 'required|string',
            'deadline'      => 'required|date',
            'client_id'     => 'required|exists:App\Models\Client,id',
            'user_id'       => 'required|exists:App\Models\User,id',
            'status'        => 'required|boolean',
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
            'description'   => 'Description',
            'deadline'      => 'Deadline',
            'client_id'     => 'Client',
            'user_id'       => 'User',
            'status'        => 'Status',
        ];
    }

}
