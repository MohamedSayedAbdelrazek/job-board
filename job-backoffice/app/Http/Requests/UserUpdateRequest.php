<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\True_;

class UserUpdateRequest extends FormRequest
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
            //
            "user_password" => "
            bail|
            required|
            string|
            min:8|
            max:255|
            regex:/[a-z]/|
            regex:/[A-Z]/|
            regex:/[0-9]/|
            regex:/[@$!%*?&#]/|"
        ];
    }

    public function messages()
    {
        return [
            'user_password.required'=>'User password is required',
            'user_password.string' => 'Owner password must be valid text.',
            'user_password.min' => 'Owner password must be at least 8 characters.',
            'user_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
    }
}
