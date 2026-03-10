<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Services\UnitAssemblyCredentials;
use App\Http\Services\UnitIdGenerator;
use App\Models\human_resource\Employee;
use App\Models\Warehouse\UnitAssembly;

class UnitController extends Controller
{
    public function index() {
        return view('dashboard.modules.warehouse.units.index');
    }

    public function create(UnitAssemblyCredentials $service) {

        return view('dashboard.modules.warehouse.units.create', [
            'unitIdPreview'   => UnitIdGenerator::generate(),
            'unitAssemblies'  => UnitAssembly::orderBy('complete_description')->get(),
            'units'           => $service->getUnitCredentials(),
        ]);
    }

    public function store() {

    }
}
