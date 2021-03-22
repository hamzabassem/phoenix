<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Store;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditons =['store_id' => Auth::user()->store_id,'deleted' => '0'];
        $categories = Category::where($conditons)->paginate(10);
        return view('dashboard.categories.showAllCategories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 4) {
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
            }
            return view('dashboard.categories.addCategory');
        }return redirect()->back()->with('error', 'you can not do this action');
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
            'description' => 'required',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'notify' => 'required|integer',

        ]);

        $data = $request->all();
        $data['store_id'] = Auth::user()->store_id;
        Category::create($data);
        return redirect()->back()->with('success', 'category has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $category = Category::all()->where('id', $id);
        foreach ($category as $value) {
            if ($value->store_id == Auth::user()->store_id) {

                return view('dashboard.categories.editCategory', compact('category'));
            } else {
                return redirect()->back()->with('error', 'you can not do this action');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'notify' => 'required|integer',

        ]);

        $category = Category::findOrFail($id);
        if ($category->store_id == Auth::user()->store_id) {
            $category->update($request->all());
            return redirect()->route('categoriesinfo')->with('success', 'category has been edited successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $category = Category::findOrFail($id);
        if ($category->store_id == Auth::user()->store_id && (Auth::user()->level == 1 || Auth::user()->level == 2)) {
            $category->update(['deleted' => '1']);
            return redirect()->back()->with('success', 'category has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
        }
    }

}
