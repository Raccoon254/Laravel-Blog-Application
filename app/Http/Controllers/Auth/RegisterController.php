<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request,[
            'name'=>'required',
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed'
        ]);

        //store details
        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        //sign user in
        auth()->attempt($request->only('email','password'));
        //redirect
        return redirect()->route('dashboard');
    }
}
