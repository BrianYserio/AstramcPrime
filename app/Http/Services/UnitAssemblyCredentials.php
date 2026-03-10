<?php

namespace App\Http\Services;

class UnitAssemblyCredentials {

    public function getUnitCredentials() {
        return [
            'units_assembly'   => config('unitassembly.units_assembly'),
        ];
    }
}
