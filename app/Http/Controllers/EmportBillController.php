<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\EmportBill;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmportBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $import = EmportBill::where('store_id',Auth::user()->store_id);
        return view('dashboard.bills.showimportbill',compact('import'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('store_id',Auth::user()->store_id)->get();
        $supplier = Supplier::where('store_id',Auth::user()->store_id)->get();
        return view('dashboard.bills.addimportbill',compact(['supplier','categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rand = rand();
        $data = $request->all();
        foreach ($request->get('description', []) as $key => $val) {
            //$category = Category::findOrFail($data['category_id'][$key]);
            EmportBill::create([
                'description' => $data['description'][$key],
                'quantity' => $data['quantity'][$key],
                'supplier_id' => $data['supplier_id'][$key],
                'category_id' => $data['category_id'][$key],
                'bill_number' => $rand,
                'processing' => '0',
                'store_id' => Auth::user()->store_id,
                'user_id' => Auth::user()->id,

            ]);
        }

/*
        $id = $request->category_id;
        $category = Category::findOrFail($id);

        $data['store_id'] = Auth::user()->store_id;
        $data['user_id'] = Auth::user()->id;
        $data['category_name'] = $category->name;
        EmportBill::create($data);*/
        return redirect()->back()->with('success','supplier added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmportBill  $emportBill
     * @return \Illuminate\Http\Response
     */
    public function show(EmportBill $emportBill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmportBill  $emportBill
     * @return \Illuminate\Http\Response
     */
    public function edit(EmportBill $emportBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmportBill  $emportBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmportBill $emportBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmportBill  $emportBill
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmportBill $emportBill)
    {
        //
    }
}
