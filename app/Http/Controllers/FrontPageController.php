<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use App\Models\categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FrontPageController extends Controller
{
    //
    public function index()
    {
        $products = Products::all();
        $categories = categories::all();
        return Inertia::render('PlayGround', ['products' => $products, 'categories' => $categories]);

    }

    public function getProductByCategories(Request $request)
    {
        $products = Products::all();
        $product =  Products::where('product_category',$request->category)->get();
        $categories = categories::all();
        return Inertia::render('PlayGround', ['products' => $products, 'categories' => $categories, 'productByCategory'=> $product]);
        
    }

}
