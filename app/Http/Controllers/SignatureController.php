<?php

namespace App\Http\Controllers;


use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SignatureController extends Controller
{
    //
   public function genSig($data, $passPhrase = null)
   {

        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5( $getString );

   }

    public function generateSignature(Request $request)
    {
        
        $cartTotal = $request->cartTotal; // This amount needs to be sourced from your application
        $passphrase = 'Ethan19980623';
        $data = array(
            'merchant_id' => '10023678',
            'merchant_key' => 'qxc0q74debfxr',      
            'return_url' => 'https://6c79-197-90-67-193.ngrok-free.app/return',
            'cancel_url' => 'http://www.yourdomain.co.za/cancel.php',
            'notify_url' => 'https://6c79-197-90-67-193.ngrok-free.app/notify',
            // Buyer details
            'name_first' => $request->first_name,
            'name_last'  =>  $request->last_name,
            'email_address'=> $request->email,
            // Transaction details
            'm_payment_id' => '1234', //Unique payment ID to pass through to notify_url
            'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
            'item_name' => 'Order#123'
        );
        $signature = $this->genSig($data, $passphrase);
        $data['signature'] = $signature;
        return Inertia::render('Checkout',['data'=>$data]);

    }
}
