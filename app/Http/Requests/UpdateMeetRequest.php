<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetRequest extends FormRequest
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
        $meetId = $this->route('meet') ? $this->route('meet')->id : null;

        return [
            'school_id' => 'required|exists:tenants,id',
            'code' => 'required|string|max:255|unique:meets,code,' . $meetId,
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}
