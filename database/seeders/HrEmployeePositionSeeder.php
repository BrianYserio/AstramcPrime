<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HrEmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $position = [
            [
                'position_description' => 'Superuser',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'President',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Executive Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'IT Head',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Web Developer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'HR Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'HR Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Importation Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Registration Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Accounting Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Accounting Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Accounting Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Treasury Officer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Treasury Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Marketing Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Graphic Artist/Video Editor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Sales Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Sales Executive',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Sales Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Warehouse/Purchasing Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Warehouse/Purchasing Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Warehouse/Purchasing Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Warehouse Man',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Canvasser/Purchaser',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Production/Services Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Production/Services Advisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Production/Services Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Auto-Mechanic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Auto-Electrician',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Maintenance Utility',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Maintenance/Driver Utility',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'General Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Sales Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Importation OIC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Registration OIC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Senior Sales Executivea',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Accounting Assistant - Accounts Receivable',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Accounting Assistant - Accounts Payable',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Compliance Officer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Sales Admin - Subic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Warehouse Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Purchasing Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Senior Web Developer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Digital Marketing Associate',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Internal Audit Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Spare Parts Analyst',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Internal Audit Assistant 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Warranty Processor',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'position_description' => 'HR Assistant 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Marketing Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Internal Audit Assistant 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Liaison Officer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Credit & Collection Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Credit Investigator/Collector',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Area Head',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Parts Counter Salesman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Process and Product Specialist',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'position_description' => 'Messenger',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];
    DB::table('hr_employee_position')->insert($position);

    }
}
