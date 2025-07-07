<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyJobRequest extends FormRequest
{
    public function authorize():bool
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
            'resume_file'=>'required|file|mimes:pdf,doc,docx|max:5120'
        ];
        
    }

    public function messages()
    {
        return
        [
            'resume_file.required'=>'The resume file is required.',
            'resume_file.file'=>'The resume file must be a file.'
        ];
    }
}
