<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Product;
use App\Models\Courier;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Доступ запрещён');
        }
    }
    
    public function index()
    {
        $this->checkAdmin();
        return view('admin.index');
    }
    
   
    public function users()
    {
        $this->checkAdmin();
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    
    public function deleteUser($id)
    {
        $this->checkAdmin();
        $user = User::findOrFail($id);
        if ($user->role !== 'admin') {
            $user->delete();
        }
        return redirect()->back()->with('success', 'Пользователь удалён');
    }
    

    public function restaurants()
    {
        $this->checkAdmin();
        $restaurants = Restaurant::all();
        return view('admin.restaurants', compact('restaurants'));
    }
    
    public function createRestaurant()
    {
        $this->checkAdmin();
        return view('admin.restaurants-create');
    }
    
    public function storeRestaurant(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|in:Ижевск,Казань',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/restaurants'), $filename);
            $data['image'] = '/images/restaurants/' . $filename;
        }
        
        Restaurant::create($data);
        return redirect()->route('admin.restaurants')->with('success', 'Ресторан добавлен');
    }
    
    public function editRestaurant($id)
    {
        $this->checkAdmin();
        $restaurant = Restaurant::findOrFail($id);
        return view('admin.restaurants-edit', compact('restaurant'));
    }
    
    public function updateRestaurant(Request $request, $id)
    {
        $this->checkAdmin();
        $restaurant = Restaurant::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|in:Ижевск,Казань',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            if ($restaurant->image && file_exists(public_path($restaurant->image))) {
                unlink(public_path($restaurant->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/restaurants'), $filename);
            $data['image'] = '/images/restaurants/' . $filename;
        }
        
        $restaurant->update($data);
        return redirect()->route('admin.restaurants')->with('success', 'Ресторан обновлён');
    }
    
    public function deleteRestaurant($id)
    {
        $this->checkAdmin();
        $restaurant = Restaurant::findOrFail($id);
        if ($restaurant->image && file_exists(public_path($restaurant->image))) {
            unlink(public_path($restaurant->image));
        }
        $restaurant->delete();
        return redirect()->back()->with('success', 'Ресторан удалён');
    }
    
   
    public function categories()
    {
        $this->checkAdmin();
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }
    
    public function createCategory()
    {
        $this->checkAdmin();
        return view('admin.categories-create');
    }
    
    public function storeCategory(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/categories'), $filename);
            $data['image'] = '/images/categories/' . $filename;
        }
        
        Category::create($data);
        return redirect()->route('admin.categories')->with('success', 'Категория добавлена');
    }
    
    public function editCategory($id)
    {
        $this->checkAdmin();
        $category = Category::findOrFail($id);
        return view('admin.categories-edit', compact('category'));
    }
    
    public function updateCategory(Request $request, $id)
    {
        $this->checkAdmin();
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/categories'), $filename);
            $data['image'] = '/images/categories/' . $filename;
        }
        
        $category->update($data);
        return redirect()->route('admin.categories')->with('success', 'Категория обновлена');
    }
    
    public function deleteCategory($id)
    {
        $this->checkAdmin();
        $category = Category::findOrFail($id);
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }
        $category->delete();
        return redirect()->back()->with('success', 'Категория удалена');
    }
    

    public function products()
    {
        $this->checkAdmin();
        $products = Product::with(['restaurant', 'category'])->get();
        return view('admin.products', compact('products'));
    }
    
    public function createProduct()
    {
        $this->checkAdmin();
        $restaurants = Restaurant::all();
        $categories = Category::all();
        return view('admin.products-create', compact('restaurants', 'categories'));
    }
    
public function storeProduct(Request $request)
{
    $this->checkAdmin();
    
    $request->validate([
        'restaurant_id' => 'required|exists:restaurants,id',
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string',
        'description' => 'nullable|string',
        'weight' => 'required|integer',
        'price' => 'required|numeric',
        'image' => 'nullable', 
    ]);
    
    $data = $request->except('image');
    
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/products'), $filename);
        $data['image'] = '/images/products/' . $filename;
    }
    
    Product::create($data);
    
    return redirect()->route('admin.products')->with('success', 'Товар добавлен');
}
    
    public function editProduct($id)
    {
        $this->checkAdmin();
        $product = Product::findOrFail($id);
        $restaurants = Restaurant::all();
        $categories = Category::all();
        return view('admin.products-edit', compact('product', 'restaurants', 'categories'));
    }
    
    public function updateProduct(Request $request, $id)
    {
        $this->checkAdmin();
        $product = Product::findOrFail($id);
        
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'weight' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $data['image'] = '/images/products/' . $filename;
        } else {
            
            $data['image'] = $product->image;
        }
        
        $product->update($data);
        return redirect()->route('admin.products')->with('success', 'Товар обновлён');
    }
    
    public function deleteProduct($id)
    {
        $this->checkAdmin();
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();
        return redirect()->back()->with('success', 'Товар удалён');
    }
    
 
    public function couriers()
    {
        $this->checkAdmin();
        $couriers = Courier::all();
        return view('admin.couriers', compact('couriers'));
    }
    
    public function createCourier()
    {
        $this->checkAdmin();
        return view('admin.couriers-create');
    }
    
    public function storeCourier(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);
        
        Courier::create($request->all());
        return redirect()->route('admin.couriers')->with('success', 'Курьер добавлен');
    }
    
    public function editCourier($id)
    {
        $this->checkAdmin();
        $courier = Courier::findOrFail($id);
        return view('admin.couriers-edit', compact('courier'));
    }
    
    public function updateCourier(Request $request, $id)
    {
        $this->checkAdmin();
        $courier = Courier::findOrFail($id);
        $courier->update($request->all());
        return redirect()->route('admin.couriers')->with('success', 'Курьер обновлён');
    }
    
    public function deleteCourier($id)
    {
        $this->checkAdmin();
        $courier = Courier::findOrFail($id);
        $courier->delete();
        return redirect()->back()->with('success', 'Курьер удалён');
    }
}