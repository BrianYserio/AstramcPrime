<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UnitIdGenerator
{
    public static function generate($prefix = 'SU', $resetYearly = true)
    {
        return DB::transaction(function () use ($prefix, $resetYearly) {

            $year = Carbon::now()->format('y');

            $query = DB::table('wh_unit_management');

            if ($resetYearly) {
                $query->where('unit_id', 'like', "{$prefix}{$year}%");
            }

            $latest = $query->lockForUpdate()
                            ->orderByDesc('unit_id')
                            ->first();

            if (!$latest) {
                $number = 1;
            } else {
                $lastNumber = intval(substr($latest->unit_id, -4));
                $number = $lastNumber + 1;
            }

            return sprintf(
                "%s%s%04d",
                $prefix,
                $year,
                $number
            );
        });
    }
}
