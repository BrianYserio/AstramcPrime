<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserLoginRequest extends FormRequest
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
            'employee_name' => ['required', 'string'],
            'employee_id'   => ['required', 'string'],
            'position'      => ['required', 'string'],
            'role'          => ['required', 'integer'],
            'company'       => ['required', 'string'],
            'branch_ids'    => ['required', 'array'],
            'branch_ids.*'  => ['integer', 'required'],

            'name'          => ['required', 'string', 'max:255', 'unique:user_accounts,username'],
            'password'      => ['required', 'string', 'min:8', 'same:confirm_password'],
            'confirm_password' => ['required', 'string', 'min:8'],
        ];
    }
}
