<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [           
            'name' => 'required|string',
            'email' => 'required|string',
            'nivel' => 'required|numeric',
            'password' => 'required|string'           
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'nivel.required' => 'O campo nível é obrigatório.',
            'nivel.numeric' => 'O campo nível deve ser um número.'
        ];
    }
}
