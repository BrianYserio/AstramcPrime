<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AstraCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies =[
                [
                    'row_id' => '1',
                    'company_id'   => 'AC001',
                    'company_name' => 'ASTRA MULTIMARKET CORPORATION',
                    'code'      => 'AMC',
                    'caddress' => '1197 Azure Building EDSA Munoz, Brgy. Katipunan, Quezon City',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '2',
                    'company_id'   => 'AC002',
                    'company_name' => '5TH RAY CORPORATION',
                    'code'      => '5RC',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '3',
                    'company_id'   => 'AC003',
                    'company_name' => 'TOPMACH CORPORATION',
                    'code'      => 'TMC',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '4',
                    'company_id'   => 'AC004',
                    'company_name' => 'SWIFT GLOBAL MARKETING CORPORATION',
                    'code'      => 'SGMC',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '5',
                    'company_id'   => 'AC005',
                    'company_name' => 'WEST2EAST CORPORATION',
                    'code'      => 'WEC',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '6',
                    'company_id'   => 'AC006',
                    'company_name' => 'MACHSOURCE CORPORATION',
                    'code'      => 'MSC',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '7',
                    'company_id'   => 'AC007',
                    'company_name' => 'UNITED TWAIN GOLD INC.',
                    'code'      => 'UTG',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '8',
                    'company_id'   => 'AC008',
                    'company_name' => 'MARKETMERGE INC.',
                    'code'      => 'MMI',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '9',
                    'company_id'   => 'AC009',
                    'company_name' => 'TONGTAH INTERNATIONAL FREIGHT FORWARDING CORP.',
                    'code'      => 'TTI',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '10',
                    'company_id'   => 'AC010',
                    'company_name' => 'BORLA ENTERPRISES',
                    'code'      => 'BOE',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '11',
                    'company_id'   => 'AC011',
                    'company_name' => 'SCUDERIA ENTERPRISES',
                    'code'      => 'SCE',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '12',
                    'company_id'   => 'AC012',
                    'company_name' => 'ANCAR MOTORS INC.',
                    'code'      => 'AMI',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'row_id' => '13',
                    'company_id'   => 'AC013',
                    'company_name' => 'SUBIC MERCHANTS CORPORATION',
                    'code'      => 'SMC',
                    'caddress' => '',
                    'is_active'   => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

        ];
        DB::table('astra_company')->insert($companies);
    }
}
