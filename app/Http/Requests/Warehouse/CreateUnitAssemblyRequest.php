<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class CreateUnitAssemblyRequest extends FormRequest
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
            'cabin_type'  => ['required', 'string'],
            'unit_type'   => ['required', 'string'],
            'wheels'      => ['required', 'integer', 'min:2'],
            'make'        => ['required', 'string'],
            'condition'   => ['required', 'string'],
            'body_type'   => ['required', 'string'],
            'gvw'         => ['required', 'numeric', 'min:0'],
            'horse_power' => ['required', 'string'],
            'user_name'   => ['nullable', 'string'],
            'engine'      => ['required', 'string'],
        ];
    }
}
