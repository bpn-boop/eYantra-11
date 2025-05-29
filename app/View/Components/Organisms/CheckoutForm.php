<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;
use Str;

class CheckoutForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $amount = 0;
        if(session('cart')) {
            foreach((array) session('cart') as $id => $details){
                $amount += $details['price'] * $details['quantity'];
            }
        }


        $tax_amount = 0;
        $transaction_uuid = 'TXN_' . Str::uuid();
        $product_code = 'TEST_PRODUCT_CODE';
        $product_service_charge = 0;
        $product_delivery_charge = 0;
        $discount = 0; // won't be passed
        $total_amount = $amount + $product_service_charge + $product_delivery_charge - $discount;
        $success_url = config('app.esewa_payment_success_redirection');
        $failure_url = config('app.esewa_payment_fail_redirection');
        $signed_field_names = 'total_amount,transaction_uuid,product_code';

        $message = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";

        $s = hash_hmac('sha256', $message, env('app.esewa_merchant_secret_key'), true);
        $signature = base64_encode($s); 

        return view('client.components.organisms.checkout-form', 
        data: compact(
            'amount',
            'tax_amount',
            'total_amount',
            'transaction_uuid',
            'product_code',
            'product_service_charge',
            'product_delivery_charge',
            'success_url',
            'failure_url',
            'signed_field_names',
            'signature')
        );
    }
}
