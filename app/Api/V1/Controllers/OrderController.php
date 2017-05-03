<?php

namespace App\Api\V1\Controllers;

use App\Cart;
use App\CartItem;
use App\Order;
use App\Shipping;
use Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public $currency = "KSH.";

//    public function __construct(){
//        $this->middleware('auth');
//    }

    public function Index(){

        $orders = Order::with('orderItems')->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function userOrders($id){

        $orders = Order::with('orderItems')->where('user_id', $id)->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function createOrder(Request $request){

        $userID = $request['id'];
        $orders = Cart::where('user_id', $userID)->first();

        $items = $orders->cartItems;
        $total = 0;
        foreach($items as $item){
            $total+=$item->total_item_price;
        }

        if ($items == null) {
            return response()->json([
                'status' => 'cart is empty'
            ]);
        }

        $order = new Order();
        $order->user_id = $userID;

        $remoteID = rand(100000,999999);
        if(Order::query()->where('remote_id', '=', $remoteID)->get()){
            $remoteID = rand(100000,999999);
        }
        $order->remote_id = $remoteID;
        $order->status = "Pending";

        $order->total = $total;
        $order->total_formatted = "KSH." . $total . "/=";

        $order->payment_type = Input::get('payment_type');
        $order->shipping_type = Input::get('shipping_type');

        $shipping_name  = Shipping::where('id', Input::get('shipping_type'))->value('name');
        $shipping_price = Shipping::where('id', Input::get('shipping_type'))->value('price');

        // Get This From Shipping Type
        $order->shipping_name = $shipping_name;
        $order->shipping_price = $shipping_price;
        $order->shipping_price_formatted = "KSH." . $shipping_price . "/=";

        // Null (for cash) MPesa code when order is paid for
        $order->payment_id = "NJKJ3487KL";   // ********
        $order->currency = "KSH";

        // We Have This
        $order->name = Input::get('first_name');
        $order->street = Input::get('street');
        $order->house_number = Input::get('house_number');
        $order->city = Input::get('city');
        $order->region = Input::get('city');
        $order->zip = Input::get('zip');

        $address = $order->house_number . ', ' .  $order->street . ', ' . $order->city;
        $order->address = $address;
        $order->email = Input::get('email');
        $order->phone = Input::get('phone');
        $order->note = Input::get('note');
        $order->items = $items;

        Mail::send('emails.order_details', array($order), function ($message){
            $message->to(Input::get('email'))
                    ->subject('Your order details');
        });

        if($order->save()){
            $orderItems = $items; //CartItem::with('products')->get();
            foreach($orderItems as $orderItem){
                $order->orderItems()->attach($orderItem->product_id, [
                    'quantity' => $orderItem->quantity,
                    'total_item_price'=> $orderItem->products->price * $orderItem->quantity,
                    'total_item_price_formatted' => $this->currency . $orderItem->products->price * $orderItem->quantity . "/=",
                    'total_discount_price'=> $orderItem->products->discount_price * $orderItem->quantity,
                    'total_discount_price_formatted' => $this->currency . $orderItem->products->discount_price * $orderItem->quantity . "/="
                ]); //for other fields
                // To delete cart item after its added to the order item table
                CartItem::destroy($orderItem->id);
            }
        }

        return response()->json([
            'status' => 'Successfully purchased products!',
            'order' => $order
        ],200);

    }
}