<?php

namespace App\Http\Controllers;

use App\Manager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');

    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /*$manager = Manager::all();*/

        $login_info = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($login_info)) {
            /*foreach ($manager as $value){*/
            /*if (Auth::user()->email ==  $value->email){return redirect()->route('manager');
            }*/
            $user = User::where('id', Auth::user()->id);
            $user->update(['state' => 1]);
            return redirect()->route('dashhome');

        } else {
            return redirect()->back()->with('error', 'wrong username or password');
        }

    }


    public function logout()
    {
        $user = User::where('id', Auth::user()->id);
        $user->update(['state' => '0']);
        Auth::logout();
        return redirect()->route('login');

    }


}
