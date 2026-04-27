<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Courier;

class OrderController extends Controller
{
   
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Войдите в аккаунт для оформления заказа');
        }
        
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        
        $couriers = Courier::all();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        return view('checkout', compact('cartItems', 'total', 'couriers'));
    }
    
    
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'courier_id' => 'required|exists:couriers,id',
            'delivery_time' => 'required|string',
            'address' => 'required|string',
            'entrance' => 'nullable|string',
            'apartment' => 'nullable|string',
            'floor' => 'nullable|string',
        ]);
        
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
       
        $order = Order::create([
            'user_id' => Auth::id(),
            'courier_id' => $request->courier_id,
            'total_price' => $total,
            'status' => 'активный',
            'delivery_time' => $request->delivery_time,
            'address' => $request->address,
            'entrance' => $request->entrance,
            'apartment' => $request->apartment,
            'floor' => $request->floor,
        ]);
        
        
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
        
        
        Cart::where('user_id', Auth::id())->delete();
        
        return view('order-success');
    }
}