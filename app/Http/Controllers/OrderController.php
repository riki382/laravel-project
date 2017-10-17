<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\User;

class OrderController extends Controller
{
    //

	public function login(Request $request)
	{

		$email = $request->email;
		$password = bcrypt(\Hash::make('admin123'));

		$user = User::where('email', $email)->where('password', $password)->where('role', 'customer')->first();

		if($user) {
			// login success,

		}

	}


    public function checkout()
    {


    	// check authentication
    	// if user is not logged in, redirect him / her to login page


    	$items = \Session::get('cart');


    	$invoice = 'PL-' . rand(100000, 999999);
    	$customer_id  = 100;


    	// echo bcrypt('admin123');
    	// echo '<br>';



    	// echo  bcrypt(\Hash::make('admin123')); // 
    	// $2y$10$DEUodAfaL8yzGmINrg1ypeqrxjq10U2cH1TYSKYjPQ88Ca1AKxnwq
    	// $2y$10$pBVzRNtXqg4DD4sQPaTD0ezt28j1dNndlqEjehRANj0wOv3ltAkQi
 

    	$order = new Order();

    	$order->invoice = $invoice;
    	// $order->

    	// dd($items);
    	$order->customer_id = $customer_id;


    	$order->total = 6000;
    	$order->status = 'p';

    	$order->save();

    	$order_id = $order->id;
    	// last_inserted_id()

    	// insert into order_item table

    	foreach($items as $item)
    	{
    		$order_item = new OrderItem();
    		$order_item->order_id = $order_id;
    		$order_item->title = $item[0]['title'];
    		$order_item->product_id = $item[0]['id'];

    		$order_item->save();
    	}

    	redirect();


    }
}
