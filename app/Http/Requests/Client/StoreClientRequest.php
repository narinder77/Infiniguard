<?php

namespace App\Http\Requests\Client;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'client_company_name' => 'required|string|max:255',
            'client_firstname' => 'required|string|max:255',
            'client_lastname' => 'required|string|max:255',
            'client_email' => 'required|email|unique:clients|max:255',
            'client_phone' => 'required|string|max:20',
            'client_provider_id' => 'required|string|min:1',
            'client_password' => 'required|string|min:8',
        ];
    }
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'client_password' => Hash::make($this->client_password), // Hash password before validation
        ]);
    }
}
