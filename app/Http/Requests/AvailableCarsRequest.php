<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailableCarsRequest extends FormRequest
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
        return [
            'employee_id' => 'required|integer|exists:employees,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'model' => 'nullable|string',
            'comfort_category' => 'nullable|string|exists:comfort_categories,name',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'Employee ID is required.',
            'employee_id.integer' => 'Employee ID must be an integer.',
            'employee_id.exists' => 'The selected Employee ID does not exist.',
            'start_time.required' => 'Start time is required.',
            'start_time.date' => 'Start time must be a valid date.',
            'start_time.after_or_equal' => 'Start time must be today or in the future.',
            'end_time.required' => 'End time is required.',
            'end_time.date' => 'End time must be a valid date.',
            'end_time.after' => 'End time must be after the start time.',
            'comfort_category.exists' => 'The selected comfort category does not exist.',
        ];
    }
}
