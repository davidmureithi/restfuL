<?php

namespace App\Api\V1\Controllers;

use App\Cart;
use App\CartItem;
use App\Order;
use App\PickUp;
use App\Product;
use App\Shipping;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public $currency = "KSH.";
    // Logic -----------------------------------------------------------------------------------------
    // Create a cart object for each user who puts items into a cart
    // In the construct limit only the authenticated users to putting and fetching cart items
    // A user relationship to cart is one to one => one user one cart and vice cersa
    // A cart relationship to cart item is many to many => one cart many items and one item many carts

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    // TODO Consider checking if $id and $userID are actually valid or available
    // pass a parameter ,id of the product you want to add
    // user must be authenticated to add product to cart
    public function addToCart(Request $request, $id){

        $userID = $request['id'];
        $quantity = $request['quantity'];

        $cart = Cart::where('user_id', $userID)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id = $userID;
            $cart->save();
        }

        $product = Product::find($id);
        $cartID = Cart::query()->where('user_id', $userID)->value('id');
        $inCart = CartItem::where('cart_id', $cartID)->where('product_id', $product->id)->value('product_id');

        if($inCart !=  $product->id){
            $cartItem  = new CartItem();
            $cartItem->product_id = $id;
            $cartItem->cart_id = $cart->id;
            $cartItem->quantity = $quantity;
            $cartItem->total_item_price = $product->price * $quantity;
            $cartItem->total_item_price_formatted = $this->currency . $product->price * $quantity . "/=";
            $cartItem->total_discount_price = $product->discount_price * $quantity;
            $cartItem->total_discount_price_formatted = $this->currency . $product->discount_price * $quantity . "/=";
            $cartItem->save();
            return response()->json([
                'Added Item' => $cartItem
            ]);
        } else {
            $oldQuantity = CartItem::where('cart_id', $cartID)->where('product_id', $id)->value('quantity');
            $newPrice = $product->price * ($oldQuantity + $quantity);
            $newDiscountPrice = $product->discount_price * ($oldQuantity + $quantity);

            DB::table('cart_items')
                ->where('product_id', $id)
                ->increment(
                    'quantity', $quantity,
                    ['total_item_price' => $newPrice,
                        'total_item_price_formatted' => $this->currency . $newPrice . "/=",
                        'total_discount_price' => $newDiscountPrice,
                        'total_discount_price_formatted' => $this->currency . $newDiscountPrice . "/="
                    ]
                );
            $updatedCartItem = CartItem::where('cart_id', $cartID)->where('product_id', $id)->get();

            return response()->json([
                'Updated Item' => $updatedCartItem
            ]);
        }
    }

    public function showAllCartProducts($userID){
        $cart = Cart::where('user_id', $userID)->first();

        if(!$cart){
            return response()->json([
                'status' => 'error'
            ], 404);
        }

        $items = $cart->cartItems;
        $total = 0;
        $totalDiscount = 0;
        foreach($items as $item){
            $total+=$item->total_item_price;
            $totalDiscount+=$item->total_discount_price;
        }
        $cartID = Cart::query()->where('user_id', $userID)->value('id');
        $products = CartItem::with('products')->where('cart_id', $cartID)->get();

        return response()->json([
            'id' => $cart->id,
            'product_count' => count($items),
            'currency' => $this->currency,
            'total_price'=>$total,
            'total_price_formatted' => $this->currency . $total . '/=',
            'total_discount_price'=>$totalDiscount,
            'total_discount_price_formatted' => $this->currency . $totalDiscount . '/=',
            'items' => $products
        ]);
    }

    public function postCheckout(Request $request){

        $userID = $request['user_id'];

        $cart = Cart::where('user_id', $userID)->first();

        if(!$cart){

        }

        $items = $cart->cartItems;
        if ($items == null) {
            return response()->json([
                'status' => 'Cart is empty'
            ]);
        }
        $order = new Order($request->all());
        $order->save();
        return response()->json([
            'status' => 'Successfully purchased products!',
        ],200);
    }

    public function deliveryType(){
        $shipping = Shipping::with('payment')->get();
        $personalPickUp = PickUp::with('payment')->get();

        return response()->json([
            'delivery' => [
                'shipping' => $shipping,
                'personal_pickup' => $personalPickUp
            ]
        ]);
    }

    public function showSingleCartProduct($id){
        $cart = Cart::where('user_id', 1)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id = !empty(Auth::user()->id) ? Auth::user()->id : 1;
            $cart->save();
        }

        $item = Product::find($id);
        return response()->json([
            'item'=>$item
        ]);
    }

    public function removeItem($id){
        // ID Here is the id of the cart item row
        // if our client sends the cart item id use the id directly
        CartItem::destroy($id);
        return response()->json([
            'Remaining' => CartItem::all()
        ]);
    }
}