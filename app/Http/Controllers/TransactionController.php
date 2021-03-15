<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Item;
use App\Store;
use App\Supplier;
use App\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $condition = ['category_id' => $id, 'store_id' => Auth::user()->store_id];
        $items = Transaction::where($condition)->paginate(10);
        $quantity = $items->sum('quantity');
        $category = Category::findOrFail($id);
        if ($category->store_id == Auth::user()->store_id) {
            return view('dashboard.operations.items', compact(['items', 'quantity', 'category']));
        } else {
            return redirect()->back()->with('error', 'wrong id number');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @param string $action
     * @return \Illuminate\Http\Response
     */

    public function create($id, $action)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $category = Category::findOrFail($id);
        $supplier = Supplier::all();
        $customer = Customer::all();
        if ($category->store_id == Auth::user()->store_id) {
            return view('dashboard.operations.operation', compact(['id', 'action', 'category','supplier','customer']));
        } else {
            return redirect()->back()->with('error', 'wrong id number');
        }
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
            'description' => 'required',
            'quantity' => 'required|integer',
            'bill' => 'required|integer',
            /*'supplier' => 'required',
            'customer' => 'required',*/

        ]);

        $quantity = $request->quantity;
        $supplier = $request->supplier;
        $customer = $request->customer;
        $export_bill = 0;
        $import_bill = 0;
        if ($request->action == 'export') {
            $quantity = -$request->quantity;
            $supplier = 0;
            $import_bill = $request->bill;
        }
        if ($request->action == 'import') {
            $customer = 0;
            $export_bill = $request->bill;
        }
        $item = Transaction::where('category_id', $request->categoryid);
        $sum = $item->sum('quantity');
        if ($request->action == 'export' && ($sum <= 0 || $sum + $quantity < 0)) {
            return redirect()->back()->with('error', 'you dont have enough items to make this action ');
        } else {
            Transaction::create([
                'operation' => $request->action,
                'description' => $request->description,
                'quantity' => $quantity,
                'userName' => Auth::user()->name,
                'store_id' => Auth::user()->store_id,
                'category_id' => $request->categoryid,
                'customer_id' => $customer,
                'supplier_id' => $supplier,
                'export_bill' => $export_bill,
                'import_bill' => $import_bill


            ]);
            return redirect()->route('items', ['id' => $request->categoryid])->with('success', 'action has been added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Item $item
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $item = Transaction::where('id', $id)->get();
        foreach ($item as $value) {
            if ($value->user_id == Auth::user()->id) {
                return view('dashboard.operations.editItem', compact(['item']));
            } else {
                return redirect()->back()->with('error', 'wrong id number');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Item $item
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'quantity' => 'required|integer',
            'storage' => 'required',

        ]);
        $item = Transaction::findOrFail($id);
        if ($item->user_id == Auth::user()->id) {
            $item->update($request->all());
            return redirect()->route('items', ['id' => $request->categoryid])->with('success', 'the action has been edited successfully');
        } else {
            return redirect()->back()->with('error', 'wrong id number');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $item = Transaction::findOrFail($id);
        if ($item->user_id == Auth::user()->id) {
            $item->delete();
            return redirect()->back()->with('success', 'the action has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'wrong id number');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function createPDF($id)
    {
        // retreive all records from db
        $items = Transaction::where('category_id', $id)->paginate(10);
        $quantity = $items->sum('quantity');
        $category = Category::findOrFail($id);
        $data = ['items' => $items, 'quantity' => $quantity, 'category' => $category];

        // share data to view
        $pdf = PDF::loadView('dashboard.operations.pdf', $data);
        return $pdf->download('invoice.pdf');

    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function imports()
    {
        $condition = ['operation' => 'import', 'store_id' => Auth::user()->store_id];
        $items = Transaction::where($condition)->paginate(10);
        $category = Category::all();

        return view('dashboard.operations.imports', compact(['items', 'category']));

    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function exports()
    {
        $condition = ['operation' => 'export', 'store_id' => Auth::user()->store_id];
        $items = Transaction::where($condition)->paginate(10);
        $category = Category::all();

        return view('dashboard.operations.exports', compact(['items', 'category']));
    }
}
