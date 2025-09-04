<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use function PHPUnit\Framework\returnArgument;

class AuthController extends Controller
{
     public function proseslogin(Request $request)
        {
            $credentials = $request->only('name', 'password');

            if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('welcome');
        }

            return back()->withErrors(['name' => 'Invalid credentials.']);
        }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function index() 
    {
        $user = Auth::user();
        return view('welcome', ['user' => $user]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('login');
        }

    public function register(Request $request)
    {
        $request->validate(['email' => [
        'required',
        'email',
        'regex:/^[^@]+@[^@]+\.[^@]+$/'],
        'password' =>'required',]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>'admin'
            
        ]);
        return redirect('login');

       

        Auth::login($user);
        return redirect('/')->with('success', 'Akun anda berhasil dibuat dan anda telah masuk.');
    }
}
