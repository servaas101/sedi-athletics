<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantRequest extends FormRequest
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
        $tenantId = $this->route('school') ? $this->route('school')->id : null;

        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:tenants,code,' . $tenantId,
            'api_token' => 'nullable|string|max:80|unique:tenants,api_token,' . $tenantId,
            'status' => 'nullable|string',
        ];
    }
}
