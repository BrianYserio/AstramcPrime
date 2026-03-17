<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\CreateUnitAssemblyRequest;
use App\Http\Services\UnitAssemblyCredentials;
use App\Http\Services\UnitIdGenerator;
use App\Models\Warehouse\UnitAssembly;
use App\Models\Warehouse\UnitManagement;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UnitController extends Controller
{
    public function index() {
        $units = UnitAssembly::all();
        return view('dashboard.modules.warehouse.units.index', compact('units'));
    }

    public function create(UnitAssemblyCredentials $service)
    {
        $assemblies = UnitAssembly::query()->whereIn('remarks', ['Make', 'Cabin', 'Body', 'Power', 'Wheels'])
            ->orderBy('cdescription')->get()->groupBy('remarks');

        return view('dashboard.modules.warehouse.units.create', [
            'unitIdPreview' => UnitIdGenerator::generate(),
            'units'         => $service->getUnitCredentials(),
            'conditions'    => $service->getUnitCredentials(),
            'makes'         => $assemblies->get('Make'),
            'cabins'        => $assemblies->get('Cabin'),
            'bodies'        => $assemblies->get('Body'),
            'powers'        => $assemblies->get('Power'),
            'wheels'        => $assemblies->get('Wheels'),
        ]);
    }

    public function store(CreateUnitAssemblyRequest $request): RedirectResponse
    {
        $employee = $request->user()->load('employee.company', 'employee.branch')->employee;

        abort_if(is_null($employee), 403, 'No employee record linked to this user.');
        abort_if(is_null($employee->company), 403, 'Employee has no associated company.');
        abort_if(is_null($employee->branch), 403, 'Employee has no associated branch.');

        $data = $request->validated();

        UnitManagement::create([
            'unit_id'       => UnitIdGenerator::generate(),
            'cabin_type'    => $data['cabin_type'],
            'unit_type'     => $data['unit_type'] ?? null,
            'num_wheels'    => $data['wheels'],
            'make'          => $data['make'],
            'condition'     => $data['condition'],
            'body_type'     => $data['body_type'],
            'gvw'           => $data['gvw'],
            'horse_type'    => $data['horse_power'],
            'prepared_by'   => $data['user_name'],
            'engine_series' => $data['engine'],
            'company_id'    => $employee->company->id,
            'branch_id'     => $employee->branch->id,
        ]);

        return redirect()->route('units.index');
    }
}
