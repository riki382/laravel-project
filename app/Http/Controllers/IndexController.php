<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Featured;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;


class IndexController extends Controller
{
    public function index()
    {
    	
    	session([
    		'carttest'	=>	'hello cart',
    		'testtest'	=>	[
    			'test completed',
    			'hello world'
    		],
    	]);


        $featured = Featured::leftJoin('product', 'product.id', '=', 'featured.product_id')
            ->select('featured.*', 'product.image')
            ->paginate(3);
        $products = Product::all();

    	return view('index', compact('featured', 'products'));
    }


    public function detail()
    {
    	echo 'here';

    	echo session('carttest');

    	echo '<pre>';
    	print_r(session('testtest'));
    }


}