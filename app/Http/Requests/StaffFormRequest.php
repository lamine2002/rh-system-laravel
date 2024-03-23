<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'team_id' => 'nullable|exists:teams,id',
            'chef_id' => 'nullable|exists:staff,id',
            'talents' => 'nullable|array',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
