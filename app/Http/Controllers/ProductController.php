<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller 
{
	public function index($slug='')
	{
		// die;
		// $products = Product::all();
		// $product = \DB::select("SELECT * FROM product WHERE status='active'")->get();


		\DB::enableQueryLog();
		if($slug) {
			// SELECT product.* FROM product JOIN category ON product.category_id=category.id WHERE product.status='active' AND category.slug='';
			// \DB::select("SELECT product.* FROM product JOIN category ON product.category_id=category.id WHERE product.status='active' AND category.slug=''");
			
			
			$products = Product::join('category', 'product.category_id', '=', 'category.id')
								->where('category.slug', $slug)
								->where('product.status', 'active')
								->select('product.*')
								->get();


		} else {
			$products = Product::where('status', 'active')->get();
		}

		// dd(\DB::getQueryLog());
		

		// $categories = Category::all();

		return view('product/list', compact('products'));
	}
}