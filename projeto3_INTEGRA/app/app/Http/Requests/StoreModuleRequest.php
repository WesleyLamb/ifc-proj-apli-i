<?php

namespace App\Http\Requests;

use App\Rules\InModel;
use App\Rules\IsPNG;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreModuleRequest extends FormRequest
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
            'value' => ['required', 'numeric'],
            'scopes' => ['required', 'array', 'min:1'],
            'logo.data' => ['required', new IsPNG(), 'max:1048576']
        ];
    }
}
