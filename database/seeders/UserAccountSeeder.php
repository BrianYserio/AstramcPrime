<?php

namespace Database\Seeders;

use App\Models\Users\UserAccount;
use Illuminate\Database\Seeder;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_accounts = [
                [
                    'user_id' => 'EMP000000',
                    'username' => 'admin',
                    'password' => bcrypt('11111111'),
                    'api_token' => bcrypt('071597'),
                    'role' => 'R000',
                ]
            ];

    UserAccount::insert($user_accounts);

    }
}
