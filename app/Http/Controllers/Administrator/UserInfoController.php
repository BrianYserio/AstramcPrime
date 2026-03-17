<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserInfoRequest;
use App\Http\Requests\Users\UpdateUserLoginRequest;
use App\Models\Users\UserAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserInfoController extends Controller
{
    public function updateUserInfo(UpdateUserInfoRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();

        $user = UserAccount::findOrFail($id);

        $user->update([
            'role_id'     => $validated['role'],
            'prepared_by' => Auth::user()->row_id,
        ]);

        // Delete old branches and re-insert
        $user->userAccountBranch()->delete();

        $branches = collect($validated['branch_ids'])->map(fn ($branchId) => [
            'company' => $validated['company'],
            'branch'  => $branchId,
        ]);

        $user->userAccountBranch()->createMany($branches->all());

        return redirect()->route('user-accounts.index')
            ->with('success', 'User info updated successfully.');
    }

    public function updateUserLogin(UpdateUserLoginRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();

        $user = UserAccount::findOrFail($id);

        $user->update([
            'username' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user-accounts.index')
            ->with('success', 'User login updated successfully.');
    }
}
