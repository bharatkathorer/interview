<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this?->user?->id),
            ],
            'password' => [$this?->user?->id ? 'nullable' : 'required'],
            'date_of_birth' => 'required|date',
        ];
    }

//    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
//    {
//        return response()->json([
//            'success' => false,
//            'message' => 'error',
//            'errors' => $validator->errors(),
//        ], 404);
//    }
}
