<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Product;
use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', function () {return view('welcome');});
Route::get('/home', 'HomeController@index');

Route::get('/add-product', function(){return view('products');})->middleware('auth');
Route::post('store', 'ProductsController@store');

Route::get('/view-orders', 'ProductsController@viewOrders');

Route::get('/search', function () {return view('search_filter_products');});

Route::get('/search/results', function(){
    $products = Product::where(function($query){
        $search = Input::has('search') ? Input::get('search') : null;
        if(isset($search)){
            $query->where('name', 'LIKE', $search);
        }
    })->get();
    // Both Return Statements Work
    return View('results')->with(compact('products'));
    // return View('results')->with('products', $products);
});

Route::get('/sort/results', function (){
    $products = Product::where('category')->orderBy(function($order){

        $name_asc = Input::has('name_asc') ? Input::get('name_asc') : null;
        $name_desc = Input::has('name_desc') ? Input::get('name_desc') : null;

        $price_asc = Input::has('price_asc') ? Input::get('price_asc') : null;
        $price_desc = Input::has('price_desc') ? Input::get('price_desc') : null;

        //Order by price descending high -> low and vice versa
        if (isset($price_desc)){
            $order->orderBy('price', 'desc');
        } elseif (isset($price_asc)){
            $order->orderBy('price', 'ASC');
        } elseif (isset($name_desc)){
            //Order by name descending z -> a and vice versa
            $order->orderBy('name', 'desc');
        } elseif ($name_asc){
            $order->orderBy('name', 'ASC');
        }
    })->get();

    return View('results')->with(compact('products'));
});

Route::get('/filter/results', function (){

    $products = Product::where(function($query){

        $min_price = Input::has('min_price') ?  Input::get('min_price') : null;
        $max_price = Input::has('max_price') ? Input::get('max_price') : $max_price = null;
        $category = Input::has('category') ? Input::get('category') : null;
        $sub_category = Input::has('sub_category') ? Input::get('sub_category') : null;

        if(isset($min_price) && isset($max_price)){

            if(isset($category) || isset($sub_category)){

                if(isset($category)){
                    foreach ($category as $cat) {
                        $query-> orWhere('price','>=',$min_price);
                        $query-> where('price','<=',$max_price);
                        $query->where('category','=', $cat);
                    }
                }

                if(isset($sub_category)){
                    foreach ($sub_category as $sub){
                        $query-> orWhere('price','>=',$min_price);
                        $query-> where('price','<=',$max_price);
                        $query->where('sub_category','=', $sub);
                    }
                }
            }

            //TODO Make this work
            if(isset($category) && isset($sub_category)) {
                foreach ($category as $cat) {
                    foreach ($sub_category as $sub) {
                        $query->where('category', '=', $cat);
                        $query->where('sub_category', '=', $sub);
                    }
                }
            }

            // Order by price descending high -> low and vice versa
            //$query->orderBy('price', 'desc');
            //$query->orderBy('price', 'ASC');
            // Order by name descending z -> a and vice versa
            //$query->orderBy('name', 'desc');
            //$query->orderBy('name', 'ASC');

            $query->where('price','>=',$min_price);
            $query->where('price','<=',$max_price);
        }
    })->orderBy('price', 'ASC')->get();
    return View('results')->with(compact('products'));
});