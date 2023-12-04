<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    
        $products = Products::all();
        return Inertia::render('Products',['products'=>$products]);
    }

    public function showAddProductsPage(){
        $categories = categories::all();
        return Inertia::render('ProductManagement/AddProduct',['categories'=>$categories]);
    }


    public function addProduct(Request $request)
    {

        $uploadedFile = $request->avatar;
        $product_name = $request->product_name;
        $product_category = $request->selectedCategory;
        $price = $request->price;
        $product_description = $request->product_description;
        $imageName = $uploadedFile->getClientOriginalName();
        $destinationDirectory = '/home/ethan/tailwind/public/images';
        $path = $destinationDirectory . '/' . $imageName;
        
        $imageFile = 'http://127.0.0.1:5173/public/images/';
        if ($uploadedFile->move($destinationDirectory, $imageName)) {
            // File was moved successfully.
        } else {
            // Error handling if the file move fails.
        }
        Products::create(['product_name'=>$product_name,'product_descruption'=>$product_description,'image_file_name'=>$imageFile.$imageName,'product_category'=>$product_category,'price'=>$price]);
        $products = Products::all();
        return Inertia::render('Products',['products'=>$products]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $product =  Products::where('id', intval($request->prod_id))->first();
        return Inertia::render('ProductManagement/EditProduct',['product'=>$product]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        // dd($request);
        $product_id = $request->product_id;
        $product = Products::find($product_id);
         if(gettype($request->avatar) === "string"){
            $product_image = $product->image_file_name;
         }else{
            $uploadedFile = $request->avatar;
            $imageName = $request->avatar->getClientOriginalName();
            $imageFile = 'http://127.0.0.1:5173/public/images/';
            $destinationDirectory = '/home/ethan/tailwind/public/images';
            $path = $destinationDirectory . '/' . $imageName;
            if ($uploadedFile->move($destinationDirectory, $imageName)) {
                // File was moved successfully.
            } else {
                // Error handling if the file move fails.
            }
            $product_image = $imageFile.$imageName;
         }

        if(!$request->product_name){
            $product_name = $product->product_name;
        }else{
            $product_name = $request->product_name;
        }
        
        if(!$request->product_description){
            
            $product_description = $product->descruption;
        }else{
            $product_description = $request->product_description;
        }


        $product->update([
            'product_name'=>$product_name,
            'product_descruption'=>$product_description,
            'price'=>$request->price,
            'image_file_name'=>$product_image,
        ]);
        return redirect()->route('products.edit')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Products $products)
    {
        //
        $product_id = $request->prod_id;
        $product = Products::find($product_id);
        $product->delete();
        return redirect()->route('products.edit')->with('success', 'Product deleted successfully');
    }

    public function addProductToCart(Request $request){
         
        
        $product_id = $request->prod_id;
        $product = Products::find($product_id);
        return Inertia::render('Cart',['product'=>$product]);

        
    }


}
