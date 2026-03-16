<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role_id'        => ['required'],
            'employee_id' => ['required'],
            'branch_ids'  => ['required', 'array'],
            'name'        => ['required', 'string', 'unique:user_accounts,username'],
            'password'    => ['required', 'string', 'min:8'],
        ];
    }
}
