<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index() {
        return view('dashboard.modules.warehouse.units.index');
    }

    public function create() {
        return view('dashboard.modules.warehouse.units.create');
    }
}
