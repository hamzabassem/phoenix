<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  int  $id
     */
    public function index($id)
    {



        $items = Item::where('category_id',$id)->paginate(10);
        $quantity = $items->sum('quantity');
        $category = Category::findOrFail($id);
        return view('dashboard.items',compact(['items','quantity','category']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  int  $id
     * @param  string  $action
     */

    public function create($id , $action)
    {
        return view('dashboard.operation',compact(['id','action']));
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
           'description' =>'required',
            'quantity' =>'required|integer',
            'storage' =>'required',

        ]);

        $quantity = $request->quantity;
        if ($request->action == 'export'){
            $quantity = -$request->quantity;
        }
        Item::create([
            'operation' => $request->action,
            'description' => $request->description,
            'quantity' => $quantity,
            'storage' => $request->storage,
            'user_id' => Auth::user()->id,
            'category_id' => $request->categoryid,

        ]);
        return redirect()->route('items',['id' => $request->categoryid])->with('success','action has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     * @param  int  $id
     */
    public function edit($id)
    {
        $item = Item::all()->where('id',$id);
        return view('dashboard.editItem',compact(['item']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' =>'required',
            'quantity' =>'required|integer',
            'storage' =>'required',

        ]);
        $item =  Item::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('items',['id' => $request->categoryid ])->with('success','the action has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success','the action has been deleted successfully');
    }
}
