<?php

namespace App\Action\HumanResource;

use App\Http\Requests\AuthEmployeeRequest;
use App\Models\human_resource\Employee;

class EmployeeUpdateAction
{
    // ✅ $employee injected as second parameter
    public function execute(AuthEmployeeRequest $request, Employee $employee): Employee
    {
        $data = $request->validated();

        $employee->update([
            // Personal Background
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
            'profile_image'  => $this->uploadProfileImage($request, $employee), // ✅ Pass $employee
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
        ]);

        $employee->employeeSchedule()->updateOrCreate(
            [], // ✅ Match condition prevents duplicates
            $this->updateSchedulePayload(
                $request->input('work_days', []),
                $request->input('time_in',   []),
                $request->input('time_out',  []),
            )
        );

        return $employee->fresh(); // ✅ Return reloaded model
    }

    private function updateSchedulePayload(array $days, array $timeIn, array $timeOut): array
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

    // ✅ $employee added to preserve existing image if no new file
    private function uploadProfileImage(AuthEmployeeRequest $request, Employee $employee): ?string
    {
        return $request->hasFile('profile_image')
            ? $request->file('profile_image')->store('profile_images', 'public')
            : $employee->profile_image;
    }
}
