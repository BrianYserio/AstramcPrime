<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_role = [
            [
                'role_id' => 'R000',
                'role_description' => 'Superuser',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R001',
                'role_description' => 'President',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R002',
                'role_description' => 'Executive Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R003',
                'role_description' => 'IT System Analyst',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R004',
                'role_description' => 'Web Developer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R005',
                'role_description' => 'HR Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R006',
                'role_description' => 'HR Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R007',
                'role_description' => 'Importation Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R008',
                'role_description' => 'Registration Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R009',
                'role_description' => 'Accounting Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R010',
                'role_description' => 'Accounting Assistant 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R011',
                'role_description' => 'Accounting Assistant 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R012',
                'role_description' => 'Treasury Officer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R013',
                'role_description' => 'Treasury Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R014',
                'role_description' => 'Marketing Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R015',
                'role_description' => 'Marketing Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R016',
                'role_description' => 'Sales Manager    ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R017',
                'role_description' => 'Sales Executive',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R018',
                'role_description' => 'Accounting Admin Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R019',
                'role_description' => 'Warehouse/Purchasing Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R020',
                'role_description' => 'Warehouse/Purchasing Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R021',
                'role_description' => 'Warehouse Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R022',
                'role_description' => 'Warehouse Man',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R023',
                'role_description' => 'Production Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R024',
                'role_description' => 'Service Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R025',
                'role_description' => 'Production/Service Advisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R026',
                'role_description' => 'Production/Service Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R027',
                'role_description' => 'Auto-Mechanic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R028',
                'role_description' => 'Auto-Electrician',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R029',
                'role_description' => 'Maintenance/Messenger Utility',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R030',
                'role_description' => 'Maintenance/Driver Utility',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R031',
                'role_description' => 'Sales Admin Multiple Branch',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R032',
                'role_description' => 'Accounting Admin Assistant Branch',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R033',
                'role_description' => 'Sales Manager Branch',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R034',
                'role_description' => 'Importation OIC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R035',
                'role_description' => 'Accounting Assistant 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R036',
                'role_description' => 'Accounting Assistant 4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R037',
                'role_description' => 'Purchasing Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R038',
                'role_description' => 'Sales Supervisor Branch',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R039',
                'role_description' => 'Sales Ancar Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R040',
                'role_description' => 'Sales Ancar Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R041',
                'role_description' => 'Sales Ancar Executive',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R042',
                'role_description' => 'Registration OIC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R043',
                'role_description' => 'General Manager - Operations',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R044',
                'role_description' => 'Internal Audit Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R045',
                'role_description' => 'Internal Audit Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R046',
                'role_description' => 'Sales Area Head',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R047',
                'role_description' => 'Credit/Collection Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'role_id' => 'R048',
                'role_description' => 'Credit/Collection Supervisor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R049',
                'role_description' => 'Credit Investigator/Collector',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R050',
                'role_description' => 'Canvasser/Purchaser',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 'R051',
                'role_description' => 'Production/Service Manager',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];
    DB::table('user_roles')->insert($user_role);
    }
}
