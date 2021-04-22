<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Store;
use App\Task;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$category = Category::where('user_id',Auth::user()->id)->get();
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        return view('dashboard.dashboard', compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level == 1 || Auth::user()->level == 2) {
            $condition = ['deleted' => '1', 'store_id' => Auth::user()->store_id];
            $items = Transaction::where($condition)->get();
            $categories = Category::where($condition)->get();
            return view('dashboard.operations.trash', compact(['items', 'categories']));
        }
        return redirect()->back()->with('error', 'only for manager');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restoreT($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $item = Transaction::findOrFail($id);
        if ($item->store_id == Auth::user()->store_id && Auth::user()->level == 2) {
            $item->update(['deleted' => '0']);
            return redirect()->back()->with('success', 'the action has been restored successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restoreC($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $category = Category::findOrFail($id);
        if ($category->store_id == Auth::user()->store_id && Auth::user()->level == 2) {
            $category->update(['deleted' => '0']);
            return redirect()->back()->with('success', 'the category has been restored successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyT($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $item = Transaction::findOrFail($id);
        if ($item->store_id == Auth::user()->store_id && Auth::user()->level == 1) {
            $item->delete();
            return redirect()->back()->with('success', 'the action has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyC($id)
    {
        $store = Store::findOrFail(auth()->user()->store_id);
        if ($store->days == 0) {
            return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
        }
        $category = Category::findOrFail($id);
        if ($category->store_id == Auth::user()->store_id && Auth::user()->level == 1) {
            $category->delete();
            return redirect()->back()->with('success', 'the category has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'you can not do this action');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyall()

        {
            $conditions = ['deleted' => '1', 'store_id' => Auth::user()->store_id];
            $store = Store::findOrFail(auth()->user()->store_id);
            if ($store->days == 0) {
                return redirect()->back()->with('warning', 'Your subscription has expired. Please renew your subscription');
            }
            $category = Category::where($conditions)->get();
            $items = Transaction::where($conditions)->get();
            if (Auth::user()->level == 1) {
                foreach ($category as $c) {
                    $c->delete();
                }
                foreach ($items as $i) {
                    $i->delete();
                }
                return redirect()->back()->with('success', 'the action has been deleted successfully');
            } else {
                return redirect()->back()->with('error', 'you can not do this action');
            }
        }
    }
