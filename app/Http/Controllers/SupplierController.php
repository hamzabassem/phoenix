<?php

namespace App\Http\Controllers;

use App\Store;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::where('store_id',auth()->user()->store_id)->paginate(10);
        return view('dashboard.customer&supplier.showsuppliers',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level == 1 || Auth::user()->level == 4) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', Lang::get('site.Your subscription has expired. Please renew your subscription'));
            }
            return view('dashboard.customer&supplier.addsupplier');
        }return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
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
            'phone' => 'required',


        ]);

        $data = $request->all();
        $data['store_id'] = Auth::user()->store_id;
        Supplier::create($data);
        return redirect()->back()->with('success', Lang::get('site.supplier added successfully'));
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
        if (Auth::user()->level == 1 || Auth::user()->level == 4) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', Lang::get('site.Your subscription has expired. Please renew your subscription'));
            }
            $supplier = Supplier::findOrFail($id);
            if ($supplier->store_id == Auth::user()->store_id) {
                return view('dashboard.customer&supplier.editsupplier', compact(['supplier', 'id']));
            }return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
        }
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
            'phone' => 'required',


        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return redirect()->back()->with('success', Lang::get('site.supplier added successfully'));
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
