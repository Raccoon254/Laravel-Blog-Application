<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Sign in user
        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('status', 'Invalid login details');
        }

        // Redirect user
        return redirect()->route('dashboard');
    }
}
