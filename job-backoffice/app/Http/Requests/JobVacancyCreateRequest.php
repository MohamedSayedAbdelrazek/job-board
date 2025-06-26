<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\True_;

class JobVacancyCreateRequest extends FormRequest
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
            "title" => "required|string|max:255",
            "location" => "required|string|max:255",
                                //@MAGIC
            "salary" => "required|numeric|min:0",
            "type" =>"required|string|max:255",
            "companyId" => "required|exists:companies,id",
            "jobCategoryId" => "required|exists:job_categories,id",
            "description" => "required|string"
        ];
    }

    public function messages()
    {
        return [
        'title.required' => 'The job title is required.',
        'title.string' => 'The job title must be a string.',
        'title.max' => 'The job title must not exceed 255 characters.',

        'location.required' => 'The location is required.',
        'location.string' => 'The location must be a string.',
        'location.max' => 'The location must not exceed 255 characters.',

        'salary.required' => 'The salary is required.',
        'salary.numeric' => 'The salary must be a numeric value.',
        'salary.min' => 'The job salary must be at least 0.',

        'type.required' => 'The job type is required.',
        'type.string' => 'The job type must be a string.',
        'type.max' => 'The job type must not exceed 255 characters.',

        'companyId.required' => 'The company field is required.',
        'companyId.exists' => 'The selected company does not exist.',

        'categoryId.required' => 'The category field is required.',
        'categoryId.exists' => 'The selected category does not exist.',

        'description.required' => 'The job description is required.',
        'description.string' => 'The job description must be a string.',
        ];
    }
}
