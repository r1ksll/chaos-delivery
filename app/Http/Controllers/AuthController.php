<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt(['phone' => $credentials['phone'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        return back()->withErrors([
            'phone' => 'Неверный телефон или пароль.',
        ]);
    }
    
    public function showRegister()
    {
        return view('register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        
        Auth::login($user);
        
        return redirect('/');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    public function profile()
    {
        $user = Auth::user();
        $activeOrders = Order::where('user_id', $user->id)
            ->where('status', 'активный')
            ->with(['items.product', 'courier'])
            ->get();
        $historyOrders = Order::where('user_id', $user->id)
            ->where('status', '!=', 'активный')
            ->with(['items.product', 'courier'])
            ->get();
        
        return view('profile', compact('user', 'activeOrders', 'historyOrders'));
    }
}