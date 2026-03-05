<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserAccountRequest;
use App\Models\human_resource\Employee;
use App\Models\Users\UserAccount;
use Illuminate\Support\Facades\DB;

class UserAccountController extends Controller
{
    public function index(){
        // store an array
        $users = DB::table('user_accounts')
            ->select('username', 'role')
            ->get()
            ->toArray();

        $employees = Employee::select(
            [
                'employee_id', 'first_name', 'middle_name',
                'last_name', 'position','created_at',
                'is_active'
            ]
        )->get();

        return view('dashboard.modules.administrator.user-accounts.index',
            [
                'employees' => $employees,
                'users' => $users
            ]
        );
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
        $users = UserAccount::create([  
            'role' => $request->input('role'),
            'branch' => $request->input('branch_ids[]'),
            'username' => $request->input('name'),
            'password' => $request->input(bcrypt('password')),
        ]);

        return view('dashboard.modules.administrator.user-accounts.index', 
        compact('users'));
    }

    public function edit() {

    }

}
