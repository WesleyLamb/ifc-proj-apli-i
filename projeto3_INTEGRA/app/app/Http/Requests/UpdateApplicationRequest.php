<?php

namespace App\Http\Requests;

use App\Rules\IsPNG;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'logo.data' => ['sometimes', 'required_without:logo.data', new IsPNG(), 'max:1048576'],
            'logo.url' => ['sometimes', 'required_without:logo.url']
        ];
    }
}
