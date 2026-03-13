<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserAccountRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\Employee;
use App\Models\Users\UserAccount;
use App\Models\Users\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['userAccount', 'UserRole'])->get();

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
        $employees = Employee::select(
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

        $user_roles = UserRole::select(
            'row_id',
            'role_description'
        )->get();

        $branches = Branch::where('is_active', 1)
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
        $request->validate([
                'role'        => 'required',
                'company'     => 'nullable',
                'employee_id' => 'nullable',
                'position'    => 'nullable',
                'branch_ids'  => 'required|array',
                'name'        => 'required|string|unique:user_accounts,username',
                'password'    => 'required|string|min:8',
            ]);
        $user = UserAccount::create([
            'user_id' => $request->input('employee_name'),
            'role_id'     => $request->input('role'),
            'username' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
        ]);

        if (!empty($request->branch_ids)) {
            $user->userBranch()->attach($request->input('branch_ids'));
        }

        $user->userRoles()->attach($request->input('role_id'));

        $users = UserAccount::with('branch', 'userRoles')->get();

        return view('dashboard.modules.administrator.user-accounts.index', compact('users'));

        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_roles = DB::table('user_roles')
                ->select('role_id','role_description')
                ->get();

        $branches = Branch::where('is_active', 1)
        ->pluck('branch_name', 'branch_id');
        // [id => name]

        $employees = Employee::with('company')->findOrFail($id);
        $companies = Company::select('company_id','company_name')->get();
        return view('dashboard.modules.administrator.user-accounts.show', [
            'employees' => $employees,
            'user_roles' => $user_roles,
            'branches' => $branches,
            'companies' => $companies
        ]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
