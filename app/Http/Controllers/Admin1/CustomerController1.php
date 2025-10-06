<?php

namespace App\Http\Controllers\Admin1;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController1 extends Controller
{
    

    public function index()
    {
        // only non-admin users (customers)
        $customers = Customer::where('is_admin', 0)->latest()->get();

        return view('organizer1.customers.index', compact('customers'));
    }
}


