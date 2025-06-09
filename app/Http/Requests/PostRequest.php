<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'bail|required|unique:posts,title',
            'body'=>'required',
            'author'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Mandatory Field',
            'body.required'=>'Mandatory Field',
            'author.required'=>'Mandatory Field'
        ];
    }
}
