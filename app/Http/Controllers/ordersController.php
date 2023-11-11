<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayFastNotification;
use Inertia\Inertia;

class ordersController extends Controller
{
    //

    public function index()
    {
        $orders = PayFastNotification::all();
        return Inertia::render('Orders',['orders'=>$orders]);
    }
}
