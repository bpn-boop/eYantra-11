<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderDetail;
use Validator;
use Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;
use DB;

class ClientController extends Controller
{
    public function index(){

        if(!Shop::exists()){
            return redirect()->route('register');
        }

        $data = [
            'shop' => Shop::first(),
            'product' => Product::all()->sortByDesc('id')->take(8),
            'category' => Category::all()->sortByDesc('id')->take(4),
            'title' => 'Home'
        ];

        return view('client.index', $data);
    }

    public function products(){
        $data = [
            'shop' => Shop::first(),
            'product' => Product::orderBy('id', 'DESC')->paginate(16),
            'category' => Category::all()->sortByDesc('id'),
            'title' => 'Products'
        ];

        return view('client.products', $data);
    }

    public function searchProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'product' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('clientHome')->withErrors($validator)->withInput();
        }else{
            
            $search = str_replace(' ', '-', strtolower($request->product));

            $data = [
                'title' => 'Result',
                'shop' => Shop::first(),
                'product' => Product::where('title', 'LIKE', '%'.$search.'%')->orderBy('id', 'DESC')->paginate(20),
                'search' => $request->product
            ];

            return view('client.productSearch', $data);

        }
    }

    public function category(){
        $data = [
            'shop' => Shop::first(),
            'category' => Category::orderBy('id', 'DESC')->paginate(12),
            'title' => 'Products'
        ];

        return view('client.category', $data);
    }

    public function categoryProducts($category){
        $data = [
            'shop' => Shop::first(),
            'category' => Category::where('name', $category)->first(),
            'title' => 'Category - '.str_replace('-', ' ', ucwords($category))
        ];

        return view('client.categoryProducts', $data);
    }

    public function productDetail($product){

        $product = Product::where('title', $product)->first();

        if($product->category->product->count() > 1){
            $recomendationProducts = $product->category->product->take(8);
        }else{
            $recomendationProducts = Product::all()->sortByDesc('id')->take(8);
        }

        $data = [
            'shop' => Shop::first(),
            'product' => $product,
            'recomendationProducts' => $recomendationProducts,
            'title' => str_replace('-', ' ', ucwords($product->title))
        ];

        return view('client.productDetail', $data);
    }

    public function checkout(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'Checkout'
        ];

        return view('client.checkout', $data);
    }

    public function checkoutSave(Request $request){
        try {
            $validator = Validator($request->all(), [
                'address' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->route('clientCheckout')->withErrors($validator)->withInput();
            }else{
                DB::beginTransaction();
                $order_code = Str::random(3).'-'.Date('Ymd');

                if(session('cart')){
                    $total = 0;
                    foreach((array) session('cart') as $id => $details){
                        $total += $details['price'] * $details['quantity'];

                        $data[$id] = [
                            'order_code' => $order_code,
                            'title' => $details['title'],
                            'price' => $details['price'],
                            'quantity' => $details['quantity'],
                        ];
                    }

                    $order = Order::create([
                        'shop_id' => Shop::first()->id,
                        'order_code' => $order_code,
                        'address' => $request->address,
                        'note' => $request->note,
                        'total' => $total,
                        'status' => 0,
                        'user_id' => auth()->user()->id
                    ]);

                    $orders_placed = [];

                    foreach($data as $id => $detail){
                        $detail['order_id'] = $order->id;
                        // $orders_placed[] = OrderDetail::insert($detail);
                        $orders_placed[] = OrderDetail::create($detail);
                    }

                    //send email here
                    // Mail::to(auth()->user()->email)->send(new OrderPlacedMail($orders_placed));

                    session()->forget('cart');
                    DB::commit();
                    return redirect()->route('getMyOrders');
                    // return redirect()->route('clientOrderCode', $order_code);
                }
            }
        } catch (\Exception $e) {
            error_log($e);
            return redirect()->route('clientCheckout')->with('error', 'Something went wrong');
        }
    }

    public function successOrder($order_code){
        $data = [
            'shop' => Shop::first(),
            'order_code' => $order_code,
            'title' => 'Checkout'
        ];

        return view('client.success-order', $data);
    }
    

    public function checkOrder(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'Check Order'
        ];

        return view('client.check-order', $data);
    }

    public function checkOrderStatus(Request $request){

        $order = Order::where('order_code', $request->order_code)->first();


        if($order){
            $data = [
                'shop' => Shop::first(),
                'order' => $order,
                'orderDetail' => OrderDetail::where('order_code', $request->order_code)->get(),
                'title' => 'Check Order'
            ];
            return view('client.check-order', $data);

        }

        $data = [
            'shop' => Shop::first(),
            'title' => 'Check Order'
        ];

        return view('client.check-order', $data);
    }

    public function about(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'About'
        ];

        return view('client.about', $data);
    }

    public function getMyOrders(){
        $orders = Order::where('user_id', auth()->user()->id)
        ->whereNotIn('status', [6])
        ->with('orderDetail')
        ->orderBy('id', 'DESC')
        ->get();
// dd($orders);
        // $data = [
        //     'shop' => Shop::first(),
        //     'orders' => $orders,
        //     'title' => 'My Orders'
        // ];
        $shop = Shop::first();

        return view('client.my-orders', compact('orders', 'shop'));

        // return view('client.my-orders', $orders, compact('shop'));
    }

    public function initiateEsewaPayment(Request $request){
        try {
            $validator = Validator($request->all(), [
                'address' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->route('clientCheckout')->withErrors($validator)->withInput();
            }else{
                DB::beginTransaction();
                $order_code = Str::uuid().'-'.now()->format('YmdHis');

                if(session('cart')){
                    $amount = 0;
                    foreach((array) session('cart') as $id => $details){
                        $amount += $details['price'] * $details['quantity'];

                        $data[$id] = [
                            'order_code' => $order_code,
                            'title' => $details['title'],
                            'price' => $details['price'],
                            'quantity' => $details['quantity'],
                        ];
                    }

                    $order = Order::create([
                        'shop_id' => Shop::first()->id,
                        'order_code' => $order_code,
                        'address' => $request->address,
                        'note' => $request->note,
                        'total' => $amount,
                        'status' => 6,
                        'user_id' => auth()->user()->id
                    ]);

                    $orders_placed = [];

                    foreach($data as $id => $detail){
                        $detail['order_id'] = $order->id;
                        // $orders_placed[] = OrderDetail::insert($detail);
                        $orders_placed[] = OrderDetail::create($detail);
                    }

                    //send email here
                    // Mail::to(auth()->user()->email)->send(new OrderPlacedMail($orders_placed));


                    // return redirect()->route('getMyOrders');

                    // now for esewa payment
                    $tax_amount = 0;
                    // $transaction_uuid = 'TXN-' . Str::uuid();order_code
                    $transaction_uuid = $order_code;
                    $product_code = 'EPAYTEST';
                    $product_service_charge = 0;
                    $product_delivery_charge = 0;
                    $discount = 0; // won't be passed
                    $total_amount = $amount + $tax_amount + $product_service_charge + $product_delivery_charge - $discount;
                    $success_url = config('app.esewa_payment_success_redirection');
                    $failure_url = config('app.esewa_payment_fail_redirection');
                    $signed_field_names = 'total_amount,transaction_uuid,product_code';

                    $message = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";

                    $s = hash_hmac('sha256', $message, config('app.esewa_merchant_secret_key'), true);
                    $signature = base64_encode($s);

                    // session()->forget('cart');
                    DB::commit();

                    return view('client.payment.esewa-redirect',
                        compact(
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
        } catch (\Exception $e) {
            error_log($e);
            return redirect()->route('clientCheckout')->with('error', 'Something went wrong during payment! Please try again');
        }
    }
}
