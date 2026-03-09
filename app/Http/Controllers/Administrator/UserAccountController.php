<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserAccountRequest;
use App\Models\Company;
use App\Models\human_resource\Employee;
use App\Models\Users\UserAccount;
use Illuminate\Support\Facades\DB;

class UserAccountController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['userAccount'])->get();

        return view('dashboard.modules.administrator.user-accounts.index',
                compact('employees'));
    }

    public function create() {
        $employees = Employee::all();

        $user_roles = DB::table('user_roles')
            ->select('role_id','role_description')
            ->get();

        $branches = DB::table('astra_branches')
        ->where('isActive', 'Yes')
        ->pluck('branch_name', 'branch_id');
        // [id => name]

        return view('dashboard.modules.administrator.user-accounts.create',
            compact('employees', 'branches', 'user_roles'),
            []);
    }

    public function store(CreateUserAccountRequest $request) {
        $users = UserAccount::with('branch', 'userRoles',[
            'role' => $request->input('role'),
            'branch' => $request->input('branch_ids[]'),
            'username' => $request->input('name'),
            'password' => $request->input(bcrypt('password')),
        ]);

        return view('dashboard.modules.administrator.user-accounts.index',
        compact('users'));
    }

    public function show(string $id) {

        $user_roles = DB::table('user_roles')
                ->select('role_id','role_description')
                ->get();

        $branches = DB::table('astra_branches')
        ->where('isActive', 'Yes')
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

    public function edit() {

    }

}
