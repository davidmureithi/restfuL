<?php

namespace App\Api\V1\Controllers;

use Auth;
use Input;
use Session;
use Validator;
use Redirect;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public $relatedLimit = 6;
    public $currency_prepend = "KSH.";
    public $currency_append = "/=";
    public $base_url = "http://www.chupachap.co.ke/products/";

    // Anyone can view products
    public function Index(){
        return Product::all();
    }

    // You need to be an admin to add products
    public function store(Request $request){
        $agent = new Product();

        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        $avatar = Input::file('image');

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('add-product')->withInput()->withErrors($validator);
        }
        else {
            // checking file is valid.
            if ($avatar->isValid()) {
                $destinationPath = 'uploads/images'; // upload path
                $extension = $avatar->getClientOriginalExtension(); // getting image extension
                $agent->name = Input::get("name");
                $agent->price = Input::get("price");
                $agent->discount_price = Input::get("discount_price");
                $agent->category = Input::get("category");
                $agent->sub_category = Input::get("sub_category");
                $agent->currency = $this->currency_prepend; //Input::get("currency");
                $agent->description = Input::get("description");
                $agent->variants = "Variants"; //Input::get("variants");

                $remoteID = rand(100000,999999);
                if(Product::query()->where('remote_id', '=', $remoteID)->get()){
                    $remoteID = rand(100000,999999);
                }
                $agent->remote_id = $remoteID;
                $agent->product_url = $this->base_url . Input::get("name");
                $agent->price_formatted = $this->currency_prepend . $request["price"] . $this->currency_append;
                $agent->discount_price_formatted =  $this->currency_prepend . $request["discount_price"] . $this->currency_append;
                $agent->code = "CPC-66757";
                $agent->mainImageHighRes = $request["image"];
                //$related = Product::query()->where('category', '=', Input::get("category")->take($this->relatedLimit)->get());
                //dump($related->count());
                $agent->related = 77;

                $agent->main_image = $avatar->getClientOriginalName(); // to get the real name of uploaded file
                $url = public_path().'/images/'. $avatar->getClientOriginalName();
                $agent->main_image_url = $url;
                $avatar->move($destinationPath, $avatar->getClientOriginalName());  // save with original name
                $agent->save();

                // sending back with message
                Session::flash('success', $agent->name . ' has been added successfully.');
                return Redirect::to('add-product');
            } else {
                // sending back with error message.
                Session::flash('error', 'There was an error! The uploaded image is not valid');
                return Redirect::to('add-product');
            }
        }
    }

    public function Product($id){
        $query = Product::query();

        if($id){
            $query->where('id', $id);
        }

        $product = $query->get();

        return response()->json([
            'The Product' => $product
        ], 200);
    }

    public function sort($sort){

        $query = Product::query();

        if($sort && $sort != "all" && $sort != "high" && $sort != "low" && $sort != "az" && $sort != "za"){
            $products = $query->where('category', $sort)->get()->all();
        } elseif ($sort == "high"){
            $products = $query->orderBy('price', 'desc')->get()->all();
        } elseif ($sort == "low"){
            $products = $query->orderBy('price', 'ASC')->get()->all();
        } elseif ($sort == "az"){
            $products = $query->orderBy('name', 'ASC')->get()->all();
        } elseif ($sort == "za"){
            $products = $query->orderBy('name', 'desc')->get()->all();
        } elseif ($sort == "all"){
            $products = $query->get()->all();
        }

        //$products = $query->get()->all();

        return response()->json([
            'products' => $products
        ], 200);
    }

    public function search($value){
        $query = Product::query();

        if($value){
            $query->where('name', 'LIKE', '%'. $value .'%');
        }

        $product = $query->get()->all();

        return response()->json([
            'products' => $product
        ], 200);
    }
}