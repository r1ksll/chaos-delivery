<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Product;

class PageController extends Controller
{
    
   public function index()
{
    $restaurants = Restaurant::all();
    $categories = Category::all();
    $products = Product::with(['restaurant', 'category'])->take(12)->get();
    
    return view('index', compact('restaurants', 'categories', 'products'));
}
    
    
    public function restaurant($id)
    {
        $restaurant = Restaurant::with('products')->findOrFail($id);
        return view('restaurant', compact('restaurant'));
    }
    
    
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['restaurant', 'category'])
            ->where('category_id', $category->id)
            ->get()
            ->groupBy('restaurant.name');
        
        return view('category', compact('category', 'products'));
    }
    
    
    public function product($id)
    {
        $product = Product::with(['restaurant', 'category'])->findOrFail($id);
        return view('product', compact('product'));
    }
}