<?php

namespace App\Http\Requests;

use App\Rules\IsBase64Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateEstablishmentRequest extends FormRequest
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
            'document' => ['required', 'string'],
            'document_type' => ['required', Rule::in(['cnpj'])],
            'logo.data' => ['required', new IsBase64Image(), 'max:1048576']
        ];
    }
}
