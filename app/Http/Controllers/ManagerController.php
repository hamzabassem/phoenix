<?php

namespace App\Http\Controllers;

use App\Manager;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard.manager.manager',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manager.addManager');
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
            'email' => 'required|email|unique:users',
            'name' => 'required|string',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ]);
        Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'days' => $request->days,
        ]);

        return redirect()->route('manager')->with('success','the manager has been added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        $user = User::where('id',Auth::user()->id)->get();
        return view('dashboard.manager.editInfo',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $manager = Manager::where('email',$request->email)->get();
        $id = Auth::user()->id;
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required',
            'password' => 'required',
        ]);




        $user = User::findOrFail($id);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user->update($data);
foreach ($manager as $value) {
    $managerr = Manager::findOrFail($value->id);
    $data = $request->all();
    $data['password'] = bcrypt($request->password);
    $managerr->update($data);
}
        return redirect()->route('manager')->with('success','your info has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $m =  Manager::all();
        $user = User::findOrFail($id);
        foreach ($m as $value){
            if ($user->email == $value->email){
                $manager = Manager::findOrFail($value->id);
                $manager->delete();

            }
        }
        $user->delete();

        return redirect()->back()->with('success','the user has been deleted successfully');
    }

    public function myusers(){
        $users = User::paginate(10);
        $total =User::all()->count('id');
        return view('dashboard.manager.users',compact('users'),compact('total'));
    }

    public function stores(){
        $stores = Store::paginate(10);
        $total =Store::all()->count('id');
        return view('dashboard.manager.stores',compact('stores'),compact('total'));
    }
}
