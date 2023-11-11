<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayFastNotification;

class PayFastController extends Controller
{
    //
    // public function handleNotification(Request $request)
    // {
    //         $payload = $request->all();
    //         PayFastNotification::create([
    //             'm_payment_id' => $payload['m_payment_id'],
    //             'pf_payment_id' => $payload['pf_payment_id'],
    //             'payment_status' => $payload['payment_status'],
    //             'item_name' => $payload['item_name'],
    //             'amount_gross' => $payload['amount_gross'],
    //         ]);
    //         return response('ITN received and stored', 200);

    // } 

    public function pfValidSignature( $pfData, $pfParamString, $pfPassphrase = null ) {
        // Calculate security signature
        if($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
        }
    
        $signature = md5( $tempParamString );
        return ( $pfData['signature'] === $signature );
    } 

    public function pfValidIP() {
        // Variable initialization
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
            );
    
        $validIps = [];
    
        foreach( $validHosts as $pfHostname ) {
            $ips = gethostbynamel( $pfHostname );
    
            if( $ips !== false )
                $validIps = array_merge( $validIps, $ips );
        }
    
        // Remove duplicates
        $validIps = array_unique( $validIps );
        $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
        if( in_array( $referrerIp, $validIps, true ) ) {
            return true;
        }
        return false;
    }



    public function pfValidPaymentData( $cartTotal, $pfData ) {
        return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
    }


    public function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://'. $pfHost .'/eng/query/validate';
    
            // Create default cURL object
            $ch = curl_init();
        
            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
            
            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
        
            // Execute cURL
            $response = curl_exec( $ch );
            curl_close( $ch );
            if ($response === 'VALID') {
                return true;
            }
        }
        return false;
    } 







    public function handleNotification(Request $request)
    {
            http_response_code(200);
            ob_flush();
            flush();
            define('SANDBOX_MODE',true);
            $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
            $pfData = $request->all();
            $pfParamString = '';

            foreach($pfData as $key => $val){
                if($key !== 'signature'){
                    $pfParamString .= $key . '=' . urlencode($val) . '&';
                }else{
                    break;
                }

            }
            $pfPassphrase = 'Ethan19980623';
            $pfParamString = substr($pfParamString, 0, -1);
            $cartTotal = $pfData['amount_gross'];


            $check1 = $this->pfValidSignature($pfData, $pfParamString,$pfPassphrase);
            $check2 = $this->pfValidIP();
            $check3 = $this->pfValidPaymentData($cartTotal, $pfData);
            $check4 = $this->pfValidServerConfirmation($pfParamString, $pfHost);
            //if($check1 && $check2 && $check3 && $check4) {
            if($check1 && $check2 && $check3 && $check4) {
                // All checks have passed, the payment is successful
                PayFastNotification::create([
                    'm_payment_id'  => $pfData['m_payment_id'],
                    'pf_payment_id' => $pfData['pf_payment_id'],
                    'payment_status'=> $pfData['payment_status'],
                    'item_name'     => $pfData['item_name'],
                    'amount_gross'  => $pfData['amount_gross'],
                ]);

            } else {
                // Some checks have failed, check payment manually and log for investigation
            } 
            return response('ITN received and processed', 200);

    } 
}