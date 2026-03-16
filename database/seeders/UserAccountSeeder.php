<?php

namespace Database\Seeders;

use App\Models\Users\UserAccount;
use App\Models\Users\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Tell MySQL to allow '0' as a valid ID for this session
        DB::statement("SET SESSION sql_mode='NO_AUTO_VALUE_ON_ZERO'");

        $role = UserRole::firstOrCreate(
            ['role_id' => 'R000'],
            ['name' => 'Administrator']
        );

        UserAccount::updateOrCreate(
            ['user_id' => 0],
            [
                'row_id'      => 0, // This will now be respected
                'user_id'     => 'EMP000000',
                'username'    => 'admin',
                'password'    => Hash::make('11111111'),
                'api_token'   => Hash::make('071597'),
                'role_id'     => $role->row_id,
            ]
        );

    }
}
