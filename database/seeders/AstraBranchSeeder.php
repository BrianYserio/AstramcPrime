<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AstraBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $branches =[
                [
                    'branch_id'   => 'AB001',
                    'branch_name' => 'ITD',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB002',
                    'branch_name' => 'ACCOUNTING',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB003',
                    'branch_name' => 'TREASURY',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB004',
                    'branch_name' => 'HRD',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB005',
                    'branch_name' => 'MARKETING',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB006',
                    'branch_name' => 'IMPORTATION',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB007',
                    'branch_name' => 'WAREHOUSE',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB008',
                    'branch_name' => 'PRODUCTION',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB009',
                    'branch_name' => 'SALES - ASTRAMC HEAD OFFICE',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB010',
                    'branch_name' => 'SALES - ASTRAMC EDSA 1',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB011',
                    'branch_name' => 'SALES - ASTRAMC EDSA 2',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB012',
                    'branch_name' => 'SALES - ASTRAMC SUBIC',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB013',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO 1',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB014',
                    'branch_name' => 'SALES - ASTRAMC CALASIAO',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB015',
                    'branch_name' => 'SALES - ASTRAMC TARLAC',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB016',
                    'branch_name' => 'SALES - ASTRAMC URDANETA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB017',
                    'branch_name' => 'SALES - ASTRAMC LA UNION',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB018',
                    'branch_name' => 'SALES - ANCAR HEAD OFFICE',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB019',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 1',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB020',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 2',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB021',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 3',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB022',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 4',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB023',
                    'branch_name' => 'SALES - ANCAR CALASIAO',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB024',
                    'branch_name' => 'SALES - ANCAR TARLAC',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB025',
                    'branch_name' => 'SALES - ANCAR URDANETA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB026',
                    'branch_name' => 'SALES - ANCAR LA UNION',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB027',
                    'branch_name' => 'SALES - ANCAR ISABELA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB028',
                    'branch_name' => 'SALES - ANCAR LA TRINIDAD',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB029',
                    'branch_name' => 'EDSA SALES',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB030',
                    'branch_name' => 'BB - CLARISSA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB031',
                    'branch_name' => 'SUBIC',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB032',
                    'branch_name' => 'CALASIAO',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB033',
                    'branch_name' => 'TARLAC',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB034',
                    'branch_name' => 'URDANETA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB035',
                    'branch_name' => 'BACNOTAN',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB036',
                    'branch_name' => 'BB-QUIRINO-ROGGIENA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB037',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO - TEAM 1',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Sub-department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB038',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO - TEAM 2',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Sub-department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB039',
                    'branch_name' => 'BB - ANGELICA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB040',
                    'branch_name' => 'SALES - ASTRAMC NUEVA ECIJA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB041',
                    'branch_name' => 'AUDIT',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB042',
                    'branch_name' => 'EDSA BACK OFFICE',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB043',
                    'branch_name' => 'REGISTRATION',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB044',
                    'branch_name' => 'AUDIT FUND',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB045',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO 2',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB046',
                    'branch_name' => 'CREDIT & COLLECTION',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB047',
                    'branch_name' => 'SALES - ASTRAMC ATTACHMENTS',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB048',
                    'branch_name' => 'SALES - ASTRAMC CALAPAN',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB049',
                    'branch_name' => 'SALES - ASTRAMC CAINTA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB050',
                    'branch_name' => 'CALAPAN',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB051',
                    'branch_name' => 'CAINTA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB052',
                    'branch_name' => 'PURCHASING',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB053',
                    'branch_name' => 'SERVICE',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB054',
                    'branch_name' => 'BB-PRD/SRV-ROGGIENA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB055',
                    'branch_name' => 'BB-WH-ROGGIENA',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB056',
                    'branch_name' => 'BALONBATO SALES',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB057',
                    'branch_name' => 'BALONBATO PRODUCTION/SERVICE',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB058',
                    'branch_name' => 'BALONBATO WAREHOUSE',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'branch_id'   => 'AB059',
                    'branch_name' => 'SALES - ASTRAMC DONGFENG',
                    'isActive'   => 'Yes',
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

        ];

        DB::table('astra_branches')->insert($branches);
    }
}
