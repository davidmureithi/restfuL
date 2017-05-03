<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {

        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signup'); //add user
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login'); //add user

        $api->get('products', 'App\\Api\\V1\\Controllers\\ProductsController@index');
        $api->get('product/{id}', 'App\\Api\\V1\\Controllers\\ProductsController@product');
        $api->get('product/store', 'App\\Api\\V1\\Controllers\\ProductsController@store');
        $api->get('products/sort={sort}', 'App\\Api\\V1\\Controllers\\ProductsController@sort');
        $api->get('products?search={query}', 'App\\Api\\V1\\Controllers\\ProductsController@search');

        $api->post('cart/{id}', 'App\\Api\\V1\\Controllers\\CartController@addToCart');
        $api->get('cart-info/{userID}', 'App\\Api\\V1\\Controllers\\CartController@showAllCartProducts');
        $api->get('cart/single/{id}', 'App\\Api\\V1\\Controllers\\CartController@showSingleCartProduct');
        $api->post('cart/remove/{id}', 'App\\Api\\V1\\Controllers\\CartController@removeItem');
        $api->post('cart/checkout', 'App\\Api\\V1\\Controllers\\CartController@postCheckout');
        $api->get('cart/delivery-info', 'App\\Api\\V1\\Controllers\\CartController@deliveryType');

        $api->post('order/create', 'App\\Api\\V1\\Controllers\\OrderController@createOrder');
        $api->get('orders/{id}', 'App\\Api\\V1\\Controllers\\OrderController@userOrders');
        $api->get('orders', 'App\\Api\\V1\\Controllers\\OrderController@index');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');

        $api->post('adduser', 'App\\Api\\V1\\Controllers\\UsersController@store'); //add user
        $api->get('users', 'App\\Api\\V1\\Controllers\\UsersController@index');    //fetch all users
        $api->get('user/{id}', 'App\\Api\\V1\\Controllers\\UsersController@show'); //fetch user with provided id
        $api->put('user/{id}', 'App\\Api\\V1\\Controllers\\UsersController@edit'); //edit user with provided id
        $api->put('user/{id}/password', 'App\\Api\\V1\\Controllers\\UsersController@changePassword'); //change users password with provided id
    });
});