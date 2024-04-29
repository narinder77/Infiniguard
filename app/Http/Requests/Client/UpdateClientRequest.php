<?php

namespace App\Http\Requests\Client;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'client_company_name' => 'required|required|string|max:255',
            'client_firstname' => 'required|required|string|max:255',
            'client_lastname' => 'required|required|string|max:255',
            'client_email' => [
                'required',
                'required',
                'email',
                Rule::unique('clients')->ignore($this->client_id, 'client_id'),
                'max:255'
            ],
            'client_phone' => 'required|required|string|max:20',
            'client_provider_id' => 'required|required|string|min:1',
            'client_password' => 'required|required|string|min:8',
        ];
    }
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('password')) {
            $this->merge([
                'client_password' => Hash::make($this->client_password), // Hash password only if provided
            ]);
        }
    }
}
