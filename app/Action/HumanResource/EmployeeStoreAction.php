<?php

namespace App\Action\HumanResource;

use App\Http\Requests\AuthEmployeeRequest;
use App\Http\Services\EmployeeIdGenerator;
use App\Models\human_resource\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeStoreAction
{
    // ✅ Inject $request directly; derive $data from it inside
    public function execute(AuthEmployeeRequest $request): Employee
    {
        $data = $request->validated(); // ✅ Use validated() for safety

        $employee = Employee::create([
            // Personal Background
            'employee_id'    => EmployeeIdGenerator::generate(),
            'first_name'     => $data['firstName'],
            'middle_name'    => $data['middleName']    ?? null,
            'last_name'      => $data['lastName'],
            'birthdate'      => $data['birthdate'],
            'gender'         => $data['gender'],
            'civil_status'   => $data['civil_status'],
            'citizenship'    => $data['citizenship'],
            'contact_number' => $data['contactNumber'],
            'email'          => $data['email'],
            'address'        => $data['address'],
            'profile_image'  => $this->uploadProfileImage($request),
            'position_id'    => $data['position'],

            // Employment Details
            'date_hired'        => $data['date_hired'],
            'date_status'       => $data['date_status'],
            'company_id'        => $data['company'],
            'level'             => $data['level'],
            'emp_status'        => $data['emp_status'],
            'branch_id'         => $data['designation'],
            'sub_branch'        => $data['sub_branch'],
            'assigned_location' => $data['assigned_location'],

            // Government Identification
            'pagibig'    => $data['pagibig_number']    ?? null,
            'philhealth' => $data['philhealth_number'] ?? null,
            'sss'        => $data['sss_number']        ?? null,
            'tin'        => $data['tin_number']        ?? null,

            'prepared_by' => Auth::user()->row_id,
        ]);

        $employee->employeeSchedule()->create(
            $this->buildSchedulePayload(
                $request->input('work_days', []),
                $request->input('time_in',   []),
                $request->input('time_out',  []),
            )
        );

        // create user id and pass it into the user account table
        // $employee->userAccount()->create([
        //     'user_id' => $employee->employee_id,
        //     'username' => $employee->first_name,
        //     'password' => Hash::make($employee->employee_id)
        // ]);

        return $employee; // ✅ Return the created model
    }

    private function buildSchedulePayload(array $days, array $timeIn, array $timeOut): array
    {
        $schedule = [];

        $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        foreach ($weekdays as $day) {
            $isActive = in_array($day, $days);

            $schedule["{$day}_in"]  = $isActive ? ($timeIn[$day]  ?? null) : null;
            $schedule["{$day}_out"] = $isActive ? ($timeOut[$day] ?? null) : null;
        }

        return $schedule;
    }

    private function uploadProfileImage(AuthEmployeeRequest $request): ?string
    {
        return $request->hasFile('profile_image')
            ? $request->file('profile_image')->store('profile_images', 'public')
            : null;
    }
}
