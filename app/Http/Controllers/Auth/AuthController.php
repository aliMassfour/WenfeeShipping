<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\LoginException;
use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(loginRequest $request)
    {
//        dd($request->only(['email','password']));
        if (!Auth::attempt($request->only(['email', 'password']))) {
//            throw LoginException::invalidCredentials();
            return redirect()->back()->with([
               "messageStatus" => 0 ,
                "message" => "invalid credentials"
            ]);
        }
        $request->session()->regenerate();
        $user = User::query()->where(['email'=>$request->email])->first();
        return redirect()->route('home')->with('user',$user);

    }
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
