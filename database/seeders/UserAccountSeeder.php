<?php

namespace Database\Seeders;

use App\Models\Users\UserAccount;
use App\Models\Users\UserRole;
use Illuminate\Database\Seeder;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = UserRole::firstOrCreate(
                ['role_id' => 'R000'], // look up role by role_id EMP000000
            );
        UserAccount::updateOrCreate(
            ['user_id' => 'EMP000000'], // search by user_id
            [
                'user_id' => 'EMP000000',
                'username'  => 'admin',
                'password'  => bcrypt('11111111'),
                'api_token' => bcrypt('071597'),
                'role_id'   => $role->row_id, // guaranteed to exist
            ]
        );

    }
}
