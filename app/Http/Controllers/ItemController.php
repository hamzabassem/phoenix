<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $condition = ['category_id' => $id, 'user_id' => Auth::user()->id];
        $items = Item::where($condition)->paginate(10);
        $quantity = $items->sum('quantity');
        $category = Category::findOrFail($id);
        if ($category->user_id == Auth::user()->id) {
            return view('dashboard.items', compact(['items', 'quantity', 'category']));
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
        if (auth()->user()->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $category = Category::findOrFail($id);
        if ($category->user_id == Auth::user()->id) {
            return view('dashboard.operation', compact(['id', 'action', 'category']));
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
            'storage' => 'required',

        ]);

        $quantity = $request->quantity;
        if ($request->action == 'export') {
            $quantity = -$request->quantity;
        }
        $item = Item::where('category_id', $request->categoryid);
        $sum = $item->sum('quantity');
        if ($request->action == 'export' && ($sum <= 0 || $sum + $quantity < 0)) {
            return redirect()->back()->with('error', 'you dont have enough items to make this action ');
        } else {
            Item::create([
                'operation' => $request->action,
                'description' => $request->description,
                'quantity' => $quantity,
                'storage' => $request->storage,
                'user_id' => Auth::user()->id,
                'category_id' => $request->categoryid,

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
        if (auth()->user()->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $item = Item::where('id', $id)->get();
        foreach ($item as $value) {
            if ($value->user_id == Auth::user()->id) {
                return view('dashboard.editItem', compact(['item']));
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
        $item = Item::findOrFail($id);
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
        if (auth()->user()->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $item = Item::findOrFail($id);
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
        $items = Item::where('category_id', $id)->paginate(10);
        $quantity = $items->sum('quantity');
        $category = Category::findOrFail($id);
        $data = ['items' => $items, 'quantity' => $quantity, 'category' => $category];

        // share data to view
        $pdf = PDF::loadView('dashboard.pdf', $data);
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
        $condition = ['operation' => 'import', 'user_id' => Auth::user()->id];
        $items = Item::where($condition)->paginate(10);
        $category = Category::all();

        return view('dashboard.imports', compact(['items', 'category']));

    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function exports()
    {
        $condition = ['operation' => 'export', 'user_id' => Auth::user()->id];
        $items = Item::where($condition)->paginate(10);
        $category = Category::all();

        return view('dashboard.exports', compact(['items', 'category']));
    }
}
