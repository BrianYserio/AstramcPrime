<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthEmployeeRequest extends FormRequest
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
            // Personal Background
            'employee_id'    => ['required', 'string'],
            'firstName'      => ['required', 'string', 'max:50'],
            'middleName'     => ['nullable', 'string', 'max:50'],
            'lastName'       => ['required', 'string', 'max:50'],
            'birthdate'      => ['required', 'date'],
            'gender'         => ['required', 'string'],
            'civil_status'   => ['required', 'string'],
            'citizenship'    => ['required', 'string'],
            'contactNumber'  => ['required', 'string', 'max:20'],
            'email'          => ['required', 'email'],
            'address'        => ['required', 'string'],
            'profile_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            // Employment Details
            'date_hired'        => ['required', 'date'],
            'date_status'       => ['required', 'date'],
            'company'           => ['required', 'string', 'max:255'],
            'level'             => ['required', 'string'],
            'emp_status'             => ['required', 'string'],
            'designation'       => ['required', 'string', 'max:255'],
            'sub_designation'   => ['nullable', 'string', 'max:255'],
            'position'          => ['required', 'string', 'max:100'],
            'assigned_location' => ['required', 'string', 'max:255'],

            // Government Identification
            'pagibig_number'    => ['nullable', 'string'],
            'philhealth_number' => ['nullable', 'string'],
            'sss_number'        => ['nullable', 'string'],
            'tin_number'        => ['nullable', 'string'],


        ];
    }
}
