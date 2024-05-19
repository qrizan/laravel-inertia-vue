<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SupplierResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('product_access');

        $productsQuery = Product::query();

        $this->applySearch($productsQuery, $request->search);

        $products = ProductResource::collection($productsQuery->paginate(5));
        return inertia('Products/Index',[
            'products' => $products,
            'search' => $request->search ?? '',
        ]);
    }

    protected function applySearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function create()
    {
        Gate::authorize('product_create');

        $categories = CategoryResource::collection(Category::all());
        $suppliers = SupplierResource::collection(Supplier::all());

        return inertia('Products/Create',[
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('product_create');

        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            $validated['image'] = $image->hashName();
        }

        Product::create($validated);


        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        Gate::authorize('product_edit');

        $categories = CategoryResource::collection(Category::all());
        $suppliers = SupplierResource::collection(Supplier::all());

        return inertia('Products/Edit', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'product' => ProductResource::make($product),
        ]);
    }  

    public function update(UpdateProductRequest $request, Product $product)
    {
        Gate::authorize('product_edit');

        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }
    
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
    

            $validated['image'] = $image->hashName();
        }else{
            $validated['image'] = $product->image;
        }
    
        $product->update($validated);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('product_create');

        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }

}
