<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        //validate
        $fields = $request->validate
        ([
            'name' => ['required', 'max:255'],
            'password' => ['required', 'min:3',],
        ]);

        if(Auth::attempt($fields, $request->remember))
        {
            //return redirect()->route('home');
            return redirect()->intended('dashboard');
        }
        else
        {
            return back()->withErrors
            ([
                'failed' => "incorrect credentials."
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
