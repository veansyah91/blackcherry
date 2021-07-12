<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();
        return view('user.index');
    }

    public function register()
    {
        return view('user.register');
    }

    public function setRole()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return view('user.set-role');
        } else{
            return abort(401);
        }
        
    }

    public function changePassword()
    {
        return view('user.change-password');
    }

    public function setPassword(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect('/income/invoice');
    }
}
