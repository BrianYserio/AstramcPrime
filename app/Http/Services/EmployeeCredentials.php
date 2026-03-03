<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class EmployeeCredentials
{
    /**
     * Get all employee-related metadata.
     * Returning an associative array makes the data much easier to use.
     */
    public function getCredentials(): array
    {
        return [
            'genders'      => config('hr_credentials.gender'),
            'civil_status' => config('hr_credentials.civil_status'),
            'citizenships' => config('hr_credentials.citizenships'),
            'levels'       => config('hr_credentials.levels'),
            'emp_status'   => config('hr_credentials.employment_status'),
            'companies'    => $this->getCompanyList(),
            'positions'    => $this->getPosition(),
            'locations'    => $this->getLocation(),
            'designations' => $this->getDesignation()
        ];
    }

    private function getCompanyList()
    {
        return DB::table('astra_company')->where('isActive', 'Yes')->pluck('company_name');
    }

    private function getPosition()
    {
        return DB::table('hr_employee_position')->where('isActive', 'Yes')->pluck('position_description');
    }

    private function getLocation()
    {
        return DB::table('hr_employee_assigned_location')
            ->where('isActive', true)
            ->pluck('name');
    }

    private function getDesignation()
    {
        // Changed to whereIn to correctly handle the array of types
        return DB::table('astra_branches')
            ->whereIn('bytype', ['Department', 'Branch', 'Sub-department'])
            ->pluck('branch_name');
    }
}
