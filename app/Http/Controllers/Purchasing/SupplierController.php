<?php

namespace App\Http\Controllers\Purchasing;

use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index() {
        return view('dashboard.modules.purchasing.supplier.index');
    }

    public function create() {
        return view('dashboard.modules.purchasing.supplier.create');
    }
}
