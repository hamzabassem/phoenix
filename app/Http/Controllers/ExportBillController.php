<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\EmportBill;
use App\ExportBill;
use App\Store;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ExportBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $export = ExportBill::where('store_id', Auth::user()->store_id)->paginate(10);
        return view('dashboard.bills.showexportbill', compact('export'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level == 1 || Auth::user()->level == 3) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', Lang::get('site.Your subscription has expired. Please renew your subscription'));
            }
            $conditions = ['store_id' => Auth::user()->store_id, 'deleted' => '0'];
            $categories = Category::where($conditions)->get();
            $customer = Customer::where('store_id', Auth::user()->store_id)->get();
            return view('dashboard.bills.addexportbill', compact(['customer', 'categories']));
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
            'customer_id[]' => 'required',
            'category_id[]' => 'required',


        ]);*/
        $rand = 0;
        $e = ExportBill::latest()->first();
        if ($e != null) {
            if (substr($e->bill_number, 0, 9) == '1' . date('Ymd')) {
                $number = $e->bill_number;
                $rand = (++$number);
            } else {
                $rand = '1' . date('Ymd') . '1000001';
            }
        } else {
            $rand = '1' . date('Ymd') . '1000001';
        }
        $data = $request->all();
        foreach ($request->get('description', []) as $key => $val) {
            //$category = Category::findOrFail($data['category_id'][$key]);
            ExportBill::create([
                'description' => $data['description'][$key],
                'quantity' => $data['quantity'][$key],
                'customer_id' => $data['customer_id'][$key],
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
     * @param int $id
     * @param \App\ExportBill $exportBill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $export = ExportBill::where('bill_number',$id)->paginate(10);
        if (auth()->user()->store_id == $export->first()->store_id) {
            return view('dashboard.bills.exportBillInfo', compact('export'),compact('id'));

        } else {
            return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level == 2 || Auth::user()->level == 1) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', Lang::get('site.Your subscription has expired. Please renew your subscription'));
            }
            $export = ExportBill::findOrFail($id);
            $condition = ['category_id' => $export->category_id, 'deleted' => '0'];
            $item = Transaction::where($condition)->get();
            $sum = $item->sum('quantity');
            if (($sum <= 0 || $sum + (-$export->quantity) < 0)) {
                return redirect()->back()->with('error', Lang::get('site.you dont have enough items to make this action'));
            } else {
                Transaction::create([
                    'operation' => 'export',
                    'description' => $export->description,
                    'quantity' => -$export->quantity,
                    'user_id' => $export->user_id,
                    'store_id' => $export->store_id,
                    'category_id' => $export->category_id,
                    'customer_id' => $export->customer_id,
                    'export_bill' => $export->bill_number,
                    'import_bill' => 0


                ]);
                $export->update(['processing' => '1']);
                return redirect()->back()->with('success', Lang::get('site.conformed'));
            }

        }
        return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ExportBill $exportBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExportBill $exportBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param \App\ExportBill $exportBill
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->level == 2) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', Lang::get('site.Your subscription has expired. Please renew your subscription'));
            }
            $export = ExportBill::findOrFail($id);
            $export->update(['processing' => '2']);
            return redirect()->back()->with('success', Lang::get('site.rejected'));
        }
        return redirect()->back()->with('error', Lang::get('site.you can not do this action'));
    }
}
