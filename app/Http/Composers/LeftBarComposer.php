<?php 

namespace App\Http\Composers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class LeftBarComposer
{
	public function compose($view)
	{

		// $view->with();

		$categories = Category::where('parent_id','=', 0)->get();
		$subCategories = Category::where('parent_id', '>', 0)->get();

		$brands = Brand::all();

		// $brands_with_count = [];
		foreach($brands as $key=>$b) 
		{
			$products = Product::where('brand_id', $b->id)->get();

			// echo $b->title;
			// echo $brands[$key]->title;

			// echo '<br>' . count($products);

			$brands[$key]->total = count($products);
		}

		// dd($brands);

		// $view->with(['categories'=>$categories]);
		$view->with(compact('categories', 'brands', 'subCategories'));
	}
}