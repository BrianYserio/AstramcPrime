<?php

namespace Database\Seeders;

use Database\Seeders\AstraBranchSeeder;
use Database\Seeders\AstraCompanySeeder;
use Database\Seeders\HrEmployeeAssignedLocationSeeder;
use Database\Seeders\HrEmployeePositionSeeder;
use Database\Seeders\UserAccountSeeder;
use Database\Seeders\UserRoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserAccountSeeder::class,
            AstraBranchSeeder::class,
            HrEmployeeAssignedLocationSeeder::class,
            HrEmployeePositionSeeder::class,
            UserRoleSeeder::class,
            AstraCompanySeeder::class,
        ]);
    }
}
