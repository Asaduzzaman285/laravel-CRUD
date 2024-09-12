<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all(); // Retrieve all products from the 'products' table
        
        // Pass the retrieved products to the 'product.index' view
        return view('product.index', compact('products'));
    }
    public function create(){
        return view('product.create');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate that the uploaded file is an image
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Create a unique name for the image
            $imagePath = $image->storeAs('images', $imageName, 'public'); // Store the image in the 'public/images' directory
        }
    
        // Create a new instance of your model and save the data
        $product = new Product(); // Assuming your model is named 'Product'
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->image = $imagePath ?? null; // Use the 'image' field as defined in the migration
        $product->save();
    
        // Redirect to a desired route with a success message
        return redirect()->route('product.index')->with('success', 'Product saved successfully!');
    }
    public function show($id)
{
    // Fetch the product by ID
    $product = Product::findOrFail($id);

    // Return the view with the product data
    return view('product.show', compact('product'));
}
public function edit($id)
{
    // Fetch the product by ID
    $product = Product::findOrFail($id);

    // Return the view with the product data
    return view('product.edit', compact('product'));
}

public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Fetch the product by ID
    $product = Product::findOrFail($id);

    // Handle the image upload
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('images', $imageName, 'public');
        $product->image = $imagePath;
    }

    // Update product details
    $product->title = $request->input('title');
    $product->description = $request->input('description');
    $product->save();

    // Redirect to the products index with a success message
    return redirect()->route('product.index')->with('success', 'Product updated successfully!');
}

public function destroy($id)
{
    // Fetch the product by ID
    $product = Product::findOrFail($id);

    // Delete the image file if it exists
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    // Delete the product
    $product->delete();

    // Redirect to the products index with a success message
    return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
}
    
}
