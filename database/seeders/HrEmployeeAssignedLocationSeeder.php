<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HrEmployeeAssignedLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $location = [
            [
              'name' => 'EDSA',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'CALASIAO',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'URDANETA',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'LA UNION',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'TARLAC',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'BALONBATO',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'QUIRINO',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'SUBIC',
              'created_at' => now(),
              'updated_at' => now()
            ],
        ];
        DB::table('hr_employee_assigned_location')->insert($location);
    }
}
