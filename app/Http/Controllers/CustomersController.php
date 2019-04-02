<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //

    public function index()
    {
        $customers = Customer::all();
        return response()->json([
            "customers" => $customers
        ], 200);
    }

    public function show($id)
    {
        $customer = Customer::whereId($id)->first();
        return response()->json([
            "customer" => $customer
        ], 200);
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->only(['name', 'email', 'phone', 'website']));
        return response()->json([
            "customer" => $customer
        ], 201);
    }

}