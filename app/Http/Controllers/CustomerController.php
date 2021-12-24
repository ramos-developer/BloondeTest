<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with(['user', 'hobbies'])->get();
        return response($customers, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'user_id' => 'exists:users,id',
            'hobbies' => 'array'
        ]);
        $customer = Customer::create([
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'user_id' => $fields['user_id']
        ]);
        $customer->hobbies()->syncWithPivotValues($fields['hobbies'], ['created_at' => now(), 'updated_at' => now()]);
        return response($customer, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with(['user', 'hobbies'])->find($id);
        return response($customer, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'string',
            'surname' => 'string',
            'user_id' => 'exists:users,id',
        ]);
        $hobbies = $request->validate(['hobbies' => 'array']);
        $customer_update = Customer::find($id);
        $customer_update->update($fields);
        $customer_update->hobbies()->syncWithPivotValues($hobbies['hobbies'], ['created_at' => now(), 'updated_at' => now()]);
        return response($customer_update, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::with(['user', 'hobbies'])->find($id);
        if($customer->delete()) {
            return response([
                'Message' => 'Deleted',
                'Customer' => $customer
            ]);
        }
    }
}
