<?php

namespace App\Http\Controllers\Administrator;

use App\Action\Administrator\UserStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserStoreRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\Employee;
use App\Models\Users\UserAccount;
use App\Models\Users\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class UserAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::query()->select([
            'row_id',
            'employee_id',
            'first_name',
            'last_name',
            'position_id',
            'is_active',
            'created_at',
        ])->get();

        return view('dashboard.modules.administrator.user-accounts.index',
        [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::query()->select(
            'employee_id',
            'first_name',
            'last_name',
            'position_id',
            'company_id',
            'emp_status'
        )->with([
                'position:row_id,position_description',
                'company:row_id,company_name',
        ])->get();

        $user_roles = UserRole::query()->select(
            'row_id',
            'role_description'
        )->get();

        $branches = Branch::query()->where('is_active', 1)
        ->pluck('branch_name', 'row_id');

        return view('dashboard.modules.administrator.user-accounts.create',
         [
            'employees' => $employees,
            'branches' => $branches,
            'user_roles' => $user_roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'password'   => ['required', 'string', 'min:8'],
            'company'    => ['required', 'string', 'max:255'],
            'branch_ids' => ['array'],
        ]);

        $employee = Employee::findOrFail($request->row_id);

        DB::transaction(function () use ($validated) {
            $user = UserAccount::create([
                'user_id'  => $employee->employee_id,
                'username' => $validated['name'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->userBranch()->create([
                'company' => $validated['company'],
                'branch'  => $validated['branch_ids'],
            ]);
        });

        return redirect()->route('administrator.user-accounts.index')
            ->with('success', 'User account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $user_roles = UserRole::select('role_id','role_description')
        //         ->get();

        // $branches = Branch::where('is_active', 1)
        // ->pluck('branch_name', 'branch_id');
        // // [id => name]

        // $employees = Employee::with('company')->findOrFail($id);
        // $companies = Company::select('company_id','company_name')->get();
        // return view('dashboard.modules.administrator.user-accounts.show', [
        //     'employees' => $employees,
        //     'user_roles' => $user_roles,
        //     'branches' => $branches,
        //     'companies' => $companies
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
