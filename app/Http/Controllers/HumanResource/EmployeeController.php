<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthEmployeeRequest;
use App\Http\Services\EmployeeCredentials;
use App\Http\Services\EmployeeIdGenerator;
use App\Models\human_resource\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index() {
        $employees = DB::table('hr_employees')->get();

        return view('dashboard.modules.human-resource.employees.index', [
            'employees' => $employees
        ]);
    }

    public function create(EmployeeCredentials $service) {  // use service for clearer and maintainable

        $employeeIdPreview = EmployeeIdGenerator::generate();
        $credentials = $service->getCredentials();

        return view('dashboard.modules.human-resource.employees.create', [
            'employeeIdPreview' => $employeeIdPreview,
            'credentials'       => $credentials
        ]);
    }

    public function store(AuthEmployeeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $days     = $request->input('work_days', []);
        $timeIn   = $request->input('time_in', []);
        $timeOut  = $request->input('time_out', []);

        DB::table('hr_employee_schedules')->updateOrInsert(
            ['employee_id' => $data['employee_id']], // unique key
            [
                'monday_in'  => in_array('monday', $days) ? ($timeIn['monday'] ?? null) : null,
                'monday_out' => in_array('monday', $days) ? ($timeOut['monday'] ?? null) : null,

                'tuesday_in'  => in_array('tuesday', $days) ? ($timeIn['tuesday'] ?? null) : null,
                'tuesday_out' => in_array('tuesday', $days) ? ($timeOut['tuesday'] ?? null) : null,

                'wednesday_in'  => in_array('wednesday', $days) ? ($timeIn['wednesday'] ?? null) : null,
                'wednesday_out' => in_array('wednesday', $days) ? ($timeOut['wednesday'] ?? null) : null,

                'thursday_in'  => in_array('thursday', $days) ? ($timeIn['thursday'] ?? null) : null,
                'thursday_out' => in_array('thursday', $days) ? ($timeOut['thursday'] ?? null) : null,

                'friday_in'  => in_array('friday', $days) ? ($timeIn['friday'] ?? null) : null,
                'friday_out' => in_array('friday', $days) ? ($timeOut['friday'] ?? null) : null,

                'saturday_in'  => in_array('saturday', $days) ? ($timeIn['saturday'] ?? null) : null,
                'saturday_out' => in_array('saturday', $days) ? ($timeOut['saturday'] ?? null) : null,

                'updated_at' => now(),
                'created_at' => now(),
            ],
        );

        Employee::create([
            // Personal Background
            'employee_id'    => $data['employee_id'],
            'first_name'     => $data['firstName'],
            'middle_name'    => $data['middleName'] ?? null,
            'last_name'      => $data['lastName'],
            'birthdate'      => $data['birthdate'],
            'gender'         => $data['gender'],
            'civil_status'   => $data['civil_status'],
            'citizenship'    => $data['citizenship'],
            'contact_number' => $data['contactNumber'],
            'email'          => $data['email'],
            'address'        => $data['address'],
            'profile_image'  => $this->uploadProfileImage($request),

            // Employment Details
            'date_hired'        => $data['date_hired'],
            'date_status'       => $data['date_status'],
            'company'           => $data['company'],
            'level'             => $data['level'],
            'emp_status'        => $data['emp_status'],
            'branch'            => $data['designation'],
            'sub_branch'        => $data['sub_designation'] ?? null,
            'position'          => $data['position'],
            'assigned_location' => $data['assigned_location'],

            // Government Identification
            'pagibig'     => $data['pagibig_number'] ?? null,
            'philhealth'  => $data['philhealth_number'] ?? null,
            'sss'         => $data['sss_number'] ?? null,
            'tin'         => $data['tin_number'] ?? null,
        ]);

        return redirect()
            ->route('employees.index',)
            ->with('success', "Employee {$data['employee_id']} created successfully!");
    }

    public function show(EmployeeCredentials $service, string $id) {

        $credentials = $service->getCredentials();
        $employees = Employee::findOrFail($id);
        return view('dashboard.modules.human-resource.employees.show', [
            'employees' => $employees,
            'credentials' => $credentials
        ]);
    }

    public function edit(EmployeeCredentials $service, string $id) {  // use service for clearer and maintainable

        $credentials = $service->getCredentials();
        $employees = Employee::findOrFail($id);
        return view('dashboard.modules.human-resource.employees.edit', [
            'employees' => $employees,
            'credentials' => $credentials
        ]);
    }

    public function update(AuthEmployeeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $days     = $request->input('work_days', []);
        $timeIn   = $request->input('time_in', []);
        $timeOut  = $request->input('time_out', []);

        DB::table('hr_employee_schedules')->updateOrInsert(
            [
                'monday_in'  => in_array('monday', $days) ? ($timeIn['monday'] ?? null) : null,
                'monday_out' => in_array('monday', $days) ? ($timeOut['monday'] ?? null) : null,

                'tuesday_in'  => in_array('tuesday', $days) ? ($timeIn['tuesday'] ?? null) : null,
                'tuesday_out' => in_array('tuesday', $days) ? ($timeOut['tuesday'] ?? null) : null,

                'wednesday_in'  => in_array('wednesday', $days) ? ($timeIn['wednesday'] ?? null) : null,
                'wednesday_out' => in_array('wednesday', $days) ? ($timeOut['wednesday'] ?? null) : null,

                'thursday_in'  => in_array('thursday', $days) ? ($timeIn['thursday'] ?? null) : null,
                'thursday_out' => in_array('thursday', $days) ? ($timeOut['thursday'] ?? null) : null,

                'friday_in'  => in_array('friday', $days) ? ($timeIn['friday'] ?? null) : null,
                'friday_out' => in_array('friday', $days) ? ($timeOut['friday'] ?? null) : null,

                'saturday_in'  => in_array('saturday', $days) ? ($timeIn['saturday'] ?? null) : null,
                'saturday_out' => in_array('saturday', $days) ? ($timeOut['saturday'] ?? null) : null,

                'updated_at' => now(),
                'created_at' => now(),
            ],
        );

        Employee::update([
            // Personal Background
            'first_name'     => $data['firstName'],
            'middle_name'    => $data['middleName'] ?? null,
            'last_name'      => $data['lastName'],
            'birthdate'      => $data['birthdate'],
            'gender'         => $data['gender'],
            'civil_status'   => $data['civil_status'],
            'citizenship'    => $data['citizenship'],
            'contact_number' => $data['contactNumber'],
            'email'          => $data['email'],
            'address'        => $data['address'],
            'profile_image'  => $this->uploadProfileImage($request),

            // Employment Details
            'date_hired'        => $data['date_hired'],
            'date_status'       => $data['date_status'],
            'company'           => $data['company'],
            'level'             => $data['level'],
            'emp_status'        => $data['emp_status'],
            'branch'            => $data['designation'],
            'sub_branch'        => $data['sub_designation'] ?? null,
            'position'          => $data['position'],
            'assigned_location' => $data['assigned_location'],

            // Government Identification
            'pagibig'     => $data['pagibig_number'] ?? null,
            'philhealth'  => $data['philhealth_number'] ?? null,
            'sss'         => $data['sss_number'] ?? null,
            'tin'         => $data['tin_number'] ?? null,
        ]);

        return redirect()
            ->route('employees.show')
            ->with('success', "Employee {$data['employee_id']} created successfully!");
    }

    private function uploadProfileImage(AuthEmployeeRequest $request): ?string
    {
        return $request->hasFile('profile_image')
            ? $request->file('profile_image')->store('profile_images', 'public')
            : null;
    }
}
