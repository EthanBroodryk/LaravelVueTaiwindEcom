<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayFastNotification;

class PayFastController extends Controller
{
    //
    public function handleNotification(Request $request)
    {
            $payload = $request->all();
            PayFastNotification::create([
                'm_payment_id' => $payload['m_payment_id'],
                'pf_payment_id' => $payload['pf_payment_id'],
                'payment_status' => $payload['payment_status'],
                'item_name' => $payload['item_name'],
                'amount_gross' => $payload['amount_gross'],
            ]);
            return response('ITN received and stored', 200);

    } 
}