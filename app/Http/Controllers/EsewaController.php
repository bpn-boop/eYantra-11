<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EsewaSuccessRequest;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shop;
use DB;
use Str;

class EsewaController extends Controller
{
    public function paymentSuccessful(Request $request)
    {//EsewaSuccessRequest
        try {
            // dd(json_encode($request->all()), json_encode($request->query()), json_encode($request->getContent()));
            // dd($request->query('data'));

            $encoded = $request->query('data');

            // Step 2: Decode Base64
            $json = base64_decode($encoded);
            // dd($json);
            // Step 3: Convert JSON to PHP array
            $data = json_decode($json, true);
            $validated = $data;
            // dd($validated);
            DB::beginTransaction();
            // $validated = $request->validated();
            // $order = Order::where('order_code', $validated['transaction_uuid'])->update(['status' => 0]);
            $order = Order::where('order_code', $validated['transaction_uuid'])->first();
            if($order){
                $order->status = 0;
                $order->save();
                $validated['order_id'] = $order->id;
            } else {
                DB::rollBack();
                return redirect('/checkout')->with('error', 'Something went wrong during payment! Please try again');
            }
            
            // dd($validated);
            Payment::create($validated);
            session()->forget('cart');
            DB::commit();

            return redirect('/carts')->with('success', 'Payment successful');
        } catch (\Exception $th) {
            error_log($th);
            DB::rollBack();
            return redirect('/checkout')->with('error', 'Something went wrong during payment! Please try again');
        }
    }

    public function paymentFailed(Request $request)
    {
        try {
            return redirect('/checkout')->with('error', 'Payment failed! Please try again');
        } catch (\Exception $th) {
            return redirect('/checkout')->with('error', 'Payment failed! Please try again');
        }
    }

}
