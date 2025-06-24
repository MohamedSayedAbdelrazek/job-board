<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\True_;

class CompanyCreateRequest extends FormRequest
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
            "name" => "required|string|max:255|unique:companies,name",
            "address" => "required|string|max:255",
            "industry" => "required|string|max:255",
            "website" => "nullable|string|url|max:255",

            //owner details
            "owner_name" => "required|string|max:255",
            "owner_email" => "required|email|unique:users,email",
            "owner_password" => "
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
            'name.required' => 'Company name is required.',
            'name.string' => 'Company name must be a valid text.',
            'name.max' => 'Company name must not exceed 255 characters.',
            'name.unique' => 'This company name already exists.',

            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a valid text.',
            'address.max' => 'Address must not exceed 255 characters.',

            'industry.required' => 'Industry is required.',
            'industry.string' => 'Industry must be a valid text.',
            'industry.max' => 'Industry must not exceed 255 characters.',

            'website.string' => 'Website must be a valid text.',
            'website.url' => 'Website must be a valid URL.',
            'website.max' => 'Website must not exceed 255 characters.',

            // Owner Details
            'owner_name.required' => 'Owner name is required.',
            'owner_name.string' => 'Owner name must be a valid text.',
            'owner_name.max' => 'Owner name must not exceed 255 characters.',

            'owner_email.required' => 'Owner email is required.',
            'owner_email.email' => 'Owner email must be a valid email address.',
            'owner_email.unique' => 'This email is already used.',

            'owner_password.required' => 'Owner password is required.',
            'owner_password.string' => 'Owner password must be valid text.',
            'owner_password.min' => 'Owner password must be at least 8 characters.',
            'owner_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
    }
}
