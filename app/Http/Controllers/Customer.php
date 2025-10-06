<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;

class Customer extends Controller
{
    public function index()
    {
        // only non-admin users (customers)
        $customers = Customer::where('is_admin', 0)->latest()->get();

        return view('customers.index', compact('customers'));
    }
}
