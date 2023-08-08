<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function index() {
        $customers = Customer::all();
        return view('customers.list', compact('customers'));
    }

    function create() {
        return view('customers.create');
    }

    function store(Request $request) {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->save();
        return redirect()->route('customers.index');
    }

    function delete(Request $request) {
        $customer = Customer::findOrFail($request->id);
        $customer->delete();
        return redirect()->route('customers.index');
    }
    function edit(Request $request) {
        $customer = Customer::findOrFail($request->id);
        return view('customers.edit', compact('customer'));
    }

    function update(Request $request) {
        $customer = Customer::findOrFail($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->save();
        return redirect()->route('customers.index');
    }
}
