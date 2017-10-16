<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Library\CartLibrary;
// use App\Models\Cart;

class CartController extends Controller 
{
	// private $session_id;

	// public function __construct()
	// {
	// 	// $this->session_id = session()->getId();
	// }

	public function update(Request $request)
	{
		$cartlib = new CartLibrary();
		$items = $cartlib->items();

		$update_data = $request->qty;
		foreach($update_data as $id=>$qty)
		{
			$item_id = md5($id);
			if(array_key_exists($item_id, $items))
			{	
				$sessionData = \Session::get('cart.'.$item_id);
				foreach($sessionData as $item)
				{
					if($item == end($sessionData))
					{
						$item['qty'] = $qty;
						$item['subtotal'] = $item['qty'] * $item['price'];
					}
				}
				$request->session()->forget('cart.'.$item_id);
				$request->session()->push('cart.'.$item_id, $item);
			}
		}

		return redirect('cart/index');


	}

	public function index()
	{

		// $session_id = $this->session_id;
		// $session_id = session()->getId();

		// echo $session_id

		// $items = Cart::where('session_id', $session_id)->get();


		// echo '<form method="post" action="/cart/update">

		// <table>

		// <tr>
		// 	<th>sn</th>
		// 	<th>item</th>
		// 	<th>price</th>
		// 	<th>qty</th>
		// 	<th>subtotal</th>
		// 	<th>Options</th>
		// </tr>

		// ';
		// $sn = 1;
		// foreach($items as $item)
		// {
		// 	echo '<tr>';
		// 	echo '<td>' . $sn++ . '</td>';
		// 	echo '<td> ' . $item->item . ' </td>';
		// 	echo '<td> ' . $item->price . '</td>';
		// 	echo '<td> <input type="number" name="qty[' . $item->id . ']" value="' . $item->qty . '" ></td>';
		// 	echo '<td> ' . $item->subtotal . '</td>';
		// 	echo '<td><a href="/cart/remove/' . $item->id . '">X</a></td>';


		// 	echo '</tr>';
			
		// }


		// echo '<tr>
		// 	<th colspan="6">
		// 	<input type="hidden" name="_token" value="' . csrf_token() . '">
		// 	<input type="submit" value="Update"></th>
		// </tr>';
		// echo '</table>';

		$cartlib = new CartLibrary();

		$items = $cartlib->items();

		// dd($items);		
		return view('cart/index', compact('items'));
	}

	public function add(Request $request, $id)
	{

		$product = Product::find($id);

		// dd($product);

		$item = [
			'id'	=>	$product->id,
			'title'	=>	$product->title,
			'price'	=>	$product->price,
			'qty'	=>	1
		];

		$cartlib = new CartLibrary();

		$cartlib->insert($item, $request);

		// CartLibrary::insert($item, $request);

		// $cartlib = new CartLibrary();

		// dd(session('cart'));

		return redirect('cart/index');

	}

	public function remove(Request $request, $id)
	{
		$cartlib = new CartLibrary();
		$items = $cartlib->items();

		$item_id = md5($id);
		if(array_key_exists($item_id, $items))
		{	
			$request->session()->forget('cart.'.$item_id);
		}

		return redirect('cart/index');
	}

}