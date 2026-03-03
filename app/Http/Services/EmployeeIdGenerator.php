<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class EmployeeIdGenerator
{
    public static function generate($prefix = 'EMP', $resetYearly = true)
    {
        return DB::transaction(function () use ($prefix, $resetYearly) {

            $year = date('Y');

            $query = DB::table('hr_employees');

            if ($resetYearly) {
                $query->where('employee_id', 'like', "{$prefix}-{$year}-%");
            }

            $latest = $query->lockForUpdate()
                            ->orderByDesc('id')
                            ->first();

            if (!$latest) {
                $number = 1;
            } else {
                $lastNumber = intval(substr($latest->employee_id, -4));
                $number = $lastNumber + 1;
            }

            return sprintf(
                "%s-%s-%04d",
                $prefix,
                $year,
                $number
            );
        });
    }
}
