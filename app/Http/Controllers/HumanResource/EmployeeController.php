<?php

namespace App\Http\Controllers\HumanResource;

use App\Action\HumanResource\EmployeeStoreAction;
use App\Action\HumanResource\EmployeeUpdateAction;
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
   public function store(AuthEmployeeRequest $request, EmployeeStoreAction $action)
    {
        // ✅ Execute the action and get back the created employee
        $employee = ($action->execute($request));

        return redirect()
            ->route('employees.index')
            ->with('success', "Employee {$employee->employee_id} created successfully!");
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

        // ✅ Build  scheduleselectedDays from (days that have a time_in value)
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


    public function update(AuthEmployeeRequest $request, EmployeeUpdateAction $action, string $id)
    {
        $employee = Employee::findOrFail($id);

        $employee = $action->execute($request, $employee); // ✅ Pass $employee to the action

        return redirect()->route('employees.index')
            ->with('success', "Employee {$employee->employee_id} updated successfully.");
    }

}
