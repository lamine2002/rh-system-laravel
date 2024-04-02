<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanningFormRequest extends FormRequest
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
            'staff_id' => 'integer|nullable',
            'team_id' => 'integer|nullable',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i|before:end_time',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'type' => 'required|string',
            'priority' => 'required|string|in:Normal,Urgent,Très urgent',
            'task' => 'required|string',
            'status' => 'required|string|in:En attente,En cours,Clôturée',
            'end_date' => 'nullable|date|after_or_equal:date',
        ];
    }
}
