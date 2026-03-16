<?php

namespace App\Action\Administrator;

use App\Http\Requests\Users\UserStoreRequest;
use App\Models\Users\UserAccount;

class UserStoreAction
{
    public function execute(UserStoreRequest $request)
    {
        $data = $request->validated(); // ✅ Use validated() for safety

        $users = UserAccount::create([
            // Personal Background
            'role_id'     => $data['role'],
            'user_id'    => $data['employee_id']    ?? null,
            'branch_id'      => $data['branch_ids'],
            'username'      => $data['name'],
            'password'         => $data['password'],
        ]);

                // create user id and pass it into the user account table
        $users->UserBranch()->create([
            'user_id' => $data['user_id'],
            'company_id' => $data['company'],
            'branch_id' => $data['branch_id'],
        ]);
    }
}
