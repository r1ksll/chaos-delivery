<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    
    private function checkAuth()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Войдите в аккаунт, чтобы добавлять товары в корзину');
        }
        return null;
    }
    
   
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Войдите в аккаунт, чтобы просмотреть корзину');
        }
        
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        return view('cart', compact('cartItems', 'total'));
    }
    
    
    public function add(Request $request, $productId)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;
        
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();
        
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }
        
        return back()->with('success', 'Товар добавлен в корзину');
    }
    
   
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        
        return redirect()->route('cart.index');
    }
    
    
    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();
        
        return redirect()->route('cart.index')->with('success', 'Товар удалён из корзины');
    }
}