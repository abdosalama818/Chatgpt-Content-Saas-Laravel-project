<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:255',
                    'position' => 'required|string|max:255',
                    'message' => 'required|string',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'sometimes|required|string|max:255',
                    'position' => 'sometimes|required|string|max:255',
                    'message' => 'sometimes|required|string',
                    'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            default:
                return [];
        }
    }
}
