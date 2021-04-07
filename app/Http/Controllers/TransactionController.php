<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\EmportBill;
use App\ExportBill;
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
        $condition = ['category_id' => $id, 'store_id' => Auth::user()->store_id,'processing' => '0'];
        $Tcondition = ['category_id' => $id, 'store_id' => Auth::user()->store_id,'deleted' => '0'];
        $items = Transaction::where($Tcondition)->paginate(10);
        $export_bill = ExportBill::where($condition)->paginate(10);
        $import_bill = EmportBill::where($condition)->paginate(10);
        $quantity = $items->sum('quantity');
        $category = Category::findOrFail($id);
        if ($category->store_id == Auth::user()->store_id && $category->deleted == '0') {
            return view('dashboard.operations.items', compact(['items', 'quantity', 'category','export_bill','import_bill']));
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
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
        $supplier = Supplier::where('store_id',Auth::user()->store_id)->get();
        $customer = Customer::where('store_id',Auth::user()->store_id)->get();
        $export = ExportBill::where('category_id',$id)->get()->unique('bill_number');
        $import = EmportBill::where('category_id',$id)->get()->unique('bill_number');
        if ($category->store_id == Auth::user()->store_id && Auth::user()->level == 2) {
            return view('dashboard.operations.operation', compact(['id', 'action', 'category','supplier','customer','import','export']));
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
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
            //'bill' => 'required|integer',
            /*'supplier' => 'required',
            'customer' => 'required',*/

        ]);

        $quantity = $request->quantity;
        $supplier = $request->customer_supplier;
        $customer = $request->customer_supplier;
        $export_bill = 0;
        $import_bill = 0;
        if ($request->action == 'export') {
            $quantity = -$request->quantity;
            $supplier = null;
            $export_bill = $request->bill_number;

            ExportBill::create([
                'description' => $request->description,
                'quantity' => $quantity,
                'customer_id' => $customer,
                'category_id' => $request->category_id,
                'bill_number' => $export_bill,
                'store_id' => Auth::user()->store_id,
                'user_id' => Auth::user()->id,

            ]);
        }
        if ($request->action == 'import') {
            $customer = null;
            $import_bill = $request->bill_number;

            EmportBill::create([
                'description' =>  $request->description,
                'quantity' => $quantity,
                'supplier_id' => $supplier,
                'category_id' => $request->category_id,
                'bill_number' => $import_bill,
                'store_id' => Auth::user()->store_id,
                'user_id' => Auth::user()->id,

            ]);

        }
        $condition = ['category_id' => $request->category_id ,'deleted' => '0'];
        $item = Transaction::where($condition)->get();
        $sum = $item->sum('quantity');
        if ($request->action == 'export' && ($sum <= 0 || $sum + $quantity < 0)) {
            return redirect()->back()->with('error', 'you dont have enough items to make this action ');
        } else {
            Transaction::create([
                'operation' => $request->action,
                'description' => $request->description,
                'quantity' => $quantity,
                'user_id' => Auth::user()->id,
                'store_id' => Auth::user()->store_id,
                'category_id' => $request->category_id,
                'customer_id' => $customer,
                'supplier_id' => $supplier,
                'export_bill' => $export_bill,
                'import_bill' => $import_bill


            ]);
            return redirect()->route('items', ['id' => $request->category_id])->with('success', 'action has been added successfully');
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
            if ($value->store_id == Auth::user()->store_id && Auth::user()->level == 2) {
                return view('dashboard.operations.editItem', compact(['item']));
            } else {
                return redirect()->back()->with('error', 'you can not do this action');
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

        ]);
        $item = Transaction::findOrFail($id);
        if ($item->store_id == Auth::user()->store_id) {
            $item->update([
                'description' => $request->description,
                'quantity' => $request->quantity
            ]);
            return redirect()->route('items', ['id' => $request->categoryid])->with('success', 'the action has been edited successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
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
        if ($item->store_id == Auth::user()->store_id && Auth::user()->level == 2) {
            $item->update(['deleted' => '1']);
            return redirect()->back()->with('success', 'the action has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
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
        $signature = Store::findOrFail(Auth::user()->store_id);
        $data = ['items' => $items, 'quantity' => $quantity, 'category' => $category, 'signature' => $signature];

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
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /*public function conform($id)
    {
        if (Auth::user()->level == 2) {
            $import = EmportBill::findOrFail($id);
            Transaction::create([
                'operation' => 'import',
                'user_id' => $import->user_id,
                'description' => $import->description,
                'quantity' => $import->quantity,
                'store_id' => $import->store_id,
                'category_id' => $import->category_id,
                'customer_id' => '0',
                'supplier_id' => $import->supplier_id,
                'export_bill' => '0',
                'import_bill' => $import->bill_number,
            ]);

            return redirect()->back()->with('sucsses', 'done');
        }return redirect()->back()->with('error','wrong id number');
    }*/
}
