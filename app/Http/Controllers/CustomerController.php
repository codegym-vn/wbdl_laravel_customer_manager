<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function index() {
        $customers = Customer::with('city')->get();
        return view('customers.list', compact('customers'));
    }

    function create() {
        $cities = City::all();
        return view('customers.create', compact('cities'));
    }

    function store(Request $request) {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->city_id = $request->city_id;
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
        $cities = City::all();
        return view('customers.edit', compact('customer', 'cities'));
    }

    function update(Request $request) {
        $customer = Customer::findOrFail($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->city_id = $request->city_id;
        $customer->save();
        return redirect()->route('customers.index');
    }
}
