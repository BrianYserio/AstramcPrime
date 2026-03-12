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
                    'row_id' => '1',
                    'branch_id'   => 'AB001',
                    'branch_name' => 'ITD',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '2',
                    'branch_id'   => 'AB002',
                    'branch_name' => 'ACCOUNTING',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '3',
                    'branch_id'   => 'AB003',
                    'branch_name' => 'TREASURY',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '4',
                    'branch_id'   => 'AB004',
                    'branch_name' => 'HRD',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '5',
                    'branch_id'   => 'AB005',
                    'branch_name' => 'MARKETING',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '6',
                    'branch_id'   => 'AB006',
                    'branch_name' => 'IMPORTATION',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '7',
                    'branch_id'   => 'AB007',
                    'branch_name' => 'WAREHOUSE',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '8',
                    'branch_id'   => 'AB008',
                    'branch_name' => 'PRODUCTION',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '9',
                    'branch_id'   => 'AB009',
                    'branch_name' => 'SALES - ASTRAMC HEAD OFFICE',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '10',
                    'branch_id'   => 'AB010',
                    'branch_name' => 'SALES - ASTRAMC EDSA 1',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '11',
                    'branch_id'   => 'AB011',
                    'branch_name' => 'SALES - ASTRAMC EDSA 2',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '12',
                    'branch_id'   => 'AB012',
                    'branch_name' => 'SALES - ASTRAMC SUBIC',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '13',
                    'branch_id'   => 'AB013',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO 1',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '14',
                    'branch_id'   => 'AB014',
                    'branch_name' => 'SALES - ASTRAMC CALASIAO',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '15',
                    'branch_id'   => 'AB015',
                    'branch_name' => 'SALES - ASTRAMC TARLAC',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '16',
                    'branch_id'   => 'AB016',
                    'branch_name' => 'SALES - ASTRAMC URDANETA',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '17',
                    'branch_id'   => 'AB017',
                    'branch_name' => 'SALES - ASTRAMC LA UNION',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '18',
                    'branch_id'   => 'AB018',
                    'branch_name' => 'SALES - ANCAR HEAD OFFICE',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '19',
                    'branch_id'   => 'AB019',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 1',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '20',
                    'branch_id'   => 'AB020',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 2',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '21',
                    'branch_id'   => 'AB021',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 3',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '22',
                    'branch_id'   => 'AB022',
                    'branch_name' => 'SALES - ANCAR TULLAHAN 4',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '23',
                    'branch_id'   => 'AB023',
                    'branch_name' => 'SALES - ANCAR CALASIAO',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '24',
                    'branch_id'   => 'AB024',
                    'branch_name' => 'SALES - ANCAR TARLAC',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '25',
                    'branch_id'   => 'AB025',
                    'branch_name' => 'SALES - ANCAR URDANETA',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '26',
                    'branch_id'   => 'AB026',
                    'branch_name' => 'SALES - ANCAR LA UNION',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '27',
                    'branch_id'   => 'AB027',
                    'branch_name' => 'SALES - ANCAR ISABELA',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '28',
                    'branch_id'   => 'AB028',
                    'branch_name' => 'SALES - ANCAR LA TRINIDAD',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '29',
                    'branch_id'   => 'AB029',
                    'branch_name' => 'EDSA SALES',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '30',
                    'branch_id'   => 'AB030',
                    'branch_name' => 'BB - CLARISSA',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '31',
                    'branch_id'   => 'AB031',
                    'branch_name' => 'SUBIC',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '32',
                    'branch_id'   => 'AB032',
                    'branch_name' => 'CALASIAO',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '33',
                    'branch_id'   => 'AB033',
                    'branch_name' => 'TARLAC',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '34',
                    'branch_id'   => 'AB034',
                    'branch_name' => 'URDANETA',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '35',
                    'branch_id'   => 'AB035',
                    'branch_name' => 'BACNOTAN',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '36',
                    'branch_id'   => 'AB036',
                    'branch_name' => 'BB-QUIRINO-ROGGIENA',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '37',
                    'branch_id'   => 'AB037',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO - TEAM 1',
                    'is_active'   => 1,
                    'bytype'      => 'Sub-department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '38',
                    'branch_id'   => 'AB038',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO - TEAM 2',
                    'is_active'   => 1,
                    'bytype'      => 'Sub-department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '39',
                    'branch_id'   => 'AB039',
                    'branch_name' => 'BB - ANGELICA',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '40',
                    'branch_id'   => 'AB040',
                    'branch_name' => 'SALES - ASTRAMC NUEVA ECIJA',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '41',
                    'branch_id'   => 'AB041',
                    'branch_name' => 'AUDIT',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '42',
                    'branch_id'   => 'AB042',
                    'branch_name' => 'EDSA BACK OFFICE',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '43',
                    'branch_id'   => 'AB043',
                    'branch_name' => 'REGISTRATION',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '44',
                    'branch_id'   => 'AB044',
                    'branch_name' => 'AUDIT FUND',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '45',
                    'branch_id'   => 'AB045',
                    'branch_name' => 'SALES - ASTRAMC QUIRINO 2',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '46',
                    'branch_id'   => 'AB046',
                    'branch_name' => 'CREDIT & COLLECTION',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '47',
                    'branch_id'   => 'AB047',
                    'branch_name' => 'SALES - ASTRAMC ATTACHMENTS',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '48',
                    'branch_id'   => 'AB048',
                    'branch_name' => 'SALES - ASTRAMC CALAPAN',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '49',
                    'branch_id'   => 'AB049',
                    'branch_name' => 'SALES - ASTRAMC CAINTA',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '50',
                    'branch_id'   => 'AB050',
                    'branch_name' => 'CALAPAN',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '51',
                    'branch_id'   => 'AB051',
                    'branch_name' => 'CAINTA',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '52',
                    'branch_id'   => 'AB052',
                    'branch_name' => 'PURCHASING',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '53',
                    'branch_id'   => 'AB053',
                    'branch_name' => 'SERVICE',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '54',
                    'branch_id'   => 'AB054',
                    'branch_name' => 'BB-PRD/SRV-ROGGIENA',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '55',
                    'branch_id'   => 'AB055',
                    'branch_name' => 'BB-WH-ROGGIENA',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '56',
                    'branch_id'   => 'AB056',
                    'branch_name' => 'BALONBATO SALES',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '57',
                    'branch_id'   => 'AB057',
                    'branch_name' => 'BALONBATO PRODUCTION/SERVICE',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '58',
                    'branch_id'   => 'AB058',
                    'branch_name' => 'BALONBATO WAREHOUSE',
                    'is_active'   => 1,
                    'bytype'      => 'Branch',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'row_id' => '59',
                    'branch_id'   => 'AB059',
                    'branch_name' => 'SALES - ASTRAMC DONGFENG',
                    'is_active'   => 1,
                    'bytype'      => 'Department',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

        ];

        DB::table('astra_branches')->insert($branches);
    }
}
