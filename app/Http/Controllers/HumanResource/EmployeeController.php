<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthEmployeeRequest;
use App\Http\Services\EmployeeCredentials;
use App\Http\Services\EmployeeIdGenerator;
use App\Models\human_resource\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('position')->get();

        return view('dashboard.modules.human-resource.employees.index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(EmployeeCredentials $service)
    {
        $employeeIdPreview = EmployeeIdGenerator::generate();
        $credentials = $service->getCredentials();

        return view('dashboard.modules.human-resource.employees.create', [
            'employeeIdPreview' => $employeeIdPreview,
            'credentials'       => $credentials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthEmployeeRequest $request)
    {
        $data = $request->validated();
        $employeeIdPreview = EmployeeIdGenerator::generate();

        // ✅ Use create(), not with()
        $employee = Employee::create([
            // Personal Background
            'employee_id'    => $employeeIdPreview,
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
        ]);

       // Laravel auto-fills employee_id from the relationship
        $employee->employeeSchedule()->create(
            $this->buildSchedulePayload(
                $request->input('work_days', []),
                $request->input('time_in',   []),
                $request->input('time_out',  []),
            )
        );

        return redirect()
            ->route('employees.index')
            ->with('success', "Employee {$employeeIdPreview} created successfully!"); // ✅ was $data['employee_id'] which doesn't exist
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

    /**
     * Display the specified resource.
     */
    public function show(EmployeeCredentials $service, string $id)
    {
        $credentials = $service->getCredentials();

        $employee = Employee::with('employeeSchedule')
        ->where('employee_id', $id)  // ✅ search by employee_id string
        ->firstOrFail();

        return view('dashboard.modules.human-resource.employees.show', [
            'employee' => $employee,
            'credentials' => $credentials
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeCredentials $service, string $id)
    {
        $credentials = $service->getCredentials();
        $employee = Employee::with('employeeSchedule')->findOrFail($id);
        $schedule = $employee->employeeSchedule;

        // ✅ Build selectedDays from schedule (days that have a time_in value)
        $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $selectedDays = $schedule
            ? collect($weekdays)->filter(fn($day) => !empty($schedule->{$day . '_in'}))->values()->toArray()
            : [];

        return view('dashboard.modules.human-resource.employees.edit', [
            'employee' => $employee,
            'credentials' => $credentials,
            'schedule' => $schedule,
            'selectedDays' => $selectedDays,
        ]);
    }


    public function update(AuthEmployeeRequest $request, string $id)
    {
        $data = $request->validated();

        $employee = Employee::findOrFail($id);

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
        ]);

        $employee->employeeSchedule()->updateOrCreate(
            [],
            $this->updateSchedulePayload(
                $request->input('work_days', []),
                $request->input('time_in',   []),
                $request->input('time_out',  []),
            )
        );

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
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

     private function uploadProfileImage(AuthEmployeeRequest $request): ?string
        {
            return $request->hasFile('profile_image')
                ? $request->file('profile_image')->store('profile_images', 'public')
                : null;
        }
}
