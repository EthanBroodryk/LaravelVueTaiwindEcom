<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FrontPageController extends Controller
{
    //
    public function index()
    {
        //

        $products = Products::all();

        return Inertia::render('Tailwind',['products'=>$products]);
    }

}
