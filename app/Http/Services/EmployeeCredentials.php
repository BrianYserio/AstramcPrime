<?php

namespace App\Http\Services;

use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\AssignedLocation;
use App\Models\human_resource\EmployeePosition;
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
            'sub_designations' => config('hr_credentials.sub_designations'),
            'companies'    => $this->getCompanyList(),
            'positions'    => $this->getPosition(),
            'locations'    => $this->getLocation(),
            'designations' => $this->getDesignation(),

        ];
    }

    private function getCompanyList()
    {
        return Company::select('row_id', 'company_name')
        ->orderBy('company_name')
        ->get();
    }

    private function getPosition()
    {
        return EmployeePosition::select('row_id', 'position_description')
        ->orderBy('position_description')
        ->get();
    }

    private function getLocation()
    {
        return AssignedLocation::select('id', 'name')
        ->orderBy('name')
        ->get();
    }

    private function getDesignation()
    {
        return Branch::select('row_id', 'branch_name')
            ->orderBy('branch_name')
            ->get();
    }
}
