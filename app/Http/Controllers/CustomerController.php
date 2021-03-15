<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::where('store_id',auth()->user()->store_id)->get();
        return view('dashboard.customer&supplier.showcustomers',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customer&supplier.addcustomer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers',


        ]);

        $data = $request->all();
        $data['store_id'] = Auth::user()->store_id;
        Customer::create($data);
        return redirect()->back()->with('success','customer added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function edit($id)
    {
        $condition = ['id' => $id, 'store_id' => Auth::user()->stoe_id];
        $customer = Customer::where($condition)->get();
        return view('dashboard.customer&supplier.editcustomer',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:10|max:10|unique:customers',


        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->back()->with('success','customer added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function destroy($id)
    {

    }
}
