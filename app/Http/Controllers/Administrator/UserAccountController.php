<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\Employee;
use App\Models\Users\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['userAccount'])->get();

        return view('dashboard.modules.administrator.user-accounts.index',
                compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();

        $user_roles = DB::table('user_roles')
            ->select('role_id','role_description')
            ->get();

        $branches = Branch::where('is_active', 1)
        ->pluck('branch_name', 'branch_id');

        return view('dashboard.modules.administrator.user-accounts.create',
            compact('employees', 'branches', 'user_roles'),
            []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = UserAccount::with('branch', 'userRoles', [
            'role' => $request->input('role'),
            'company' => $request->input('company'),
            $branchIds = $request->input('branch_ids'),
            'username' => $request->input('name'),
            'password' => $request->input(bcrypt('password')),
        ]);
        return view('dashboard.modules.administrator.user-accounts.index',
        compact('users'));
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
