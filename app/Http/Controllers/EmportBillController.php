<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\EmportBill;
use App\Store;
use App\Supplier;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class EmportBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $import = EmportBill::where('store_id', Auth::user()->store_id)->paginate(10);
        return view('dashboard.bills.showimportbill', compact('import'));
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
            $conditions = ['store_id' => Auth::user()->store_id, 'deleted' => '0'];
            $categories = Category::where($conditions)->get();
            $supplier = Supplier::where('store_id', Auth::user()->store_id)->get();
            return view('dashboard.bills.addimportbill', compact(['supplier', 'categories']));
        }
        return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$request->validate([
            'quantity[]' => 'required',
            'supplier_id[]' => 'required',
            'category_id[]' => 'required',


        ]);*/
        $rand = 0;
        $e = EmportBill::latest()->first();
        if ($e != null) {
            $number = substr($e->bill_number, -7);
            $rand = '2'.date('Ymd').(++$number);
        }else{
            $rand = '2'.date('Ymd').'1000001';
        }
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
        return redirect()->back()->with('success', Lang::get('site.bill added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level == 2) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', Lang::get('site.Your subscription has expired. Please renew your subscription'));
            }
            $import = EmportBill::findOrFail($id);

            Transaction::create([
                'operation' => 'import',
                'description' => $import->description,
                'quantity' => $import->quantity,
                'user_id' => $import->user_id,
                'store_id' => $import->store_id,
                'category_id' => $import->category_id,
                'supplier_id' => $import->supplier_id,
                'export_bill' => 0,
                'import_bill' => $import->bill_number


            ]);
            $import->update(['processing' => '1']);
            return redirect()->back()->with('success', Lang::get('site.conformed'));
        }
        return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\EmportBill $emportBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmportBill $emportBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param \App\EmportBill $emportBill
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->level == 2) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', Lang::get('site.Your subscription has expired. Please renew your subscription'));
            }
            $import = EmportBill::findOrFail($id);
            $import->update(['processing' => '2']);
            return redirect()->back()->with('success', Lang::get('site.rejected'));
        }
        return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
    }
}
