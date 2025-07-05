<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'meet_id' => 'required|exists:meets,id',
            'gender' => 'required|string',
            'category' => 'required|string',
            'distance' => 'required|string',
            'round' => 'required|string',
            'heat_number' => 'required|integer',
            'scheduled_time' => 'required|date_format:H:i:s',
        ];
    }
}
