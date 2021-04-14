<?php

namespace App\Http\Controllers;

use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  int  $store
     *
     */
    public function create($store)
    {
        $dstore = Crypt::decryptString($store);
        $company = Store::where('name',$dstore)->get();
        return view('auth.register',compact('company'));
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


            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'store_id' => Crypt::decryptString($request->store_id),


            ]);


        return redirect()->route('login')->with('success','your account created successfully please login');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::where('id',Auth::user()->id)->get();
        return view('dashboard.user.editUser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required',
            'password' => 'required',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user->update($data);
        if(Auth::user()->level == 1) {
            
            $image = $request->signature;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move("img/signature/", $image_new_name);
            $store = Store::findOrFail(Auth::user()->store_id);
            $store->update(['signature' => 'img/signature/'.$image_new_name]);
        }
        return redirect()->route('dashhome')->with('success','your info has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @param  int  $days
     * @return \Illuminate\Http\Response
     */
    public function updatedays($days)
    {
        $day = Crypt::decryptString($days);
        $users = Store::where('id', Auth::user()->store_id)->get();
        foreach ($users as $user)
            $user->update([
                'days' => $user->days + $day,
            ]);

        return redirect()->route('dashhome')->with('success','your info has been edited successfully');
    }


    public function showAllUsers(){
        if (Auth::user()->level == '1'){
            return view('dashboard.user.adduser');
        }
    }



    public function createUser(){
        if (Auth::user()->level == '1'){
            return view('dashboard.user.adduser');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['store_id'] = Auth::user()->store_id;
        $data['level'] = $request->level;
        User::create($data);
        return redirect()->back()->with('success','user created successfully');
    }

}
