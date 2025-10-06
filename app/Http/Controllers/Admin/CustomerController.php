<?php

namespace App\Http\Controllers\Admin;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    

    public function index()
    {
        // only non-admin users (customers)
        $customers = Customer::where('is_admin', 0)->latest()->get();

        return view('organizer.customers.index', compact('customers'));
    }
}


