<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('user_id',Auth::user()->id)->paginate(10);
        return view('dashboard.showAllCategories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.addCategory');
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
            'name' =>'required',
            'description' =>'required',
            'buying_price' =>'required|integer',
            'selling_price' =>'required|integer',
            'notify' =>'required|integer',

        ]);

        $data = $request->all();
        $data['user_id'] =  Auth::user()->id;
        Category::create($data);
        return redirect()->route('addcategory')->with('success','category has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function edit($id)
    {
        $category = Category::all()->where('id',$id);
        return view('dashboard.editCategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required',
            'description' =>'required',
            'buying_price' =>'required|integer',
            'selling_price' =>'required|integer',
            'notify' =>'required|integer',

        ]);

        $category =  Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categoriesinfo')->with('success','category has been edited successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     * @param integer $id
     */
    public function destroy($id)
    {
        Item::where('category_id',$id)->delete();
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success','category has been deleted successfully');
    }
}
