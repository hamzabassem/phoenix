<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Store;
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
        $customer = Customer::where('store_id', auth()->user()->store_id)->paginate(10);
        return view('dashboard.customer&supplier.showcustomers', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->level == 1 || auth()->user()->level == 3) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
            }
            return view('dashboard.customer&supplier.addcustomer');
        }return redirect()->back()->with('error','you can not do this action');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',


        ]);

        $data = $request->all();
        $data['store_id'] = Auth::user()->store_id;
        Customer::create($data);
        return redirect()->back()->with('success', 'customer added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Customer $customer
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->level == 1 || auth()->user()->level == 3) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
            }
            $customer = Customer::findOrFail($id);
            if ($customer->store_id == Auth::user()->store_id) {
                return view('dashboard.customer&supplier.editcustomer', compact(['customer', 'id']));
            }
        }return redirect()->back()->with('error','you can not do this action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',


        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->back()->with('success', 'customer added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Customer $customer
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
