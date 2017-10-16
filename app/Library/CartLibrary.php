<?php 

namespace App\Library;

use Illuminate\Http\Request;




/**

$cart = [
	'1'		=>	[
		'id'		=>	1,
		'title'		=>	'Samsung mobile s7',
		'price'		=>	75000,
		'qty'		=>	3,
		'subtotal'	=>	225000
	],
	'7'		=>	[
		'id'		=>	7,
		'title'		=>	'Samsung mobile s7',
		'price'		=>	75000,
		'qty'		=>	3,
		'subtotal'	=>	225000
	],
	'6'		=>	[
		'id'		=>	6,
		'title'		=>	'Samsung mobile s7',
		'price'		=>	75000,
		'qty'		=>	3,
		'subtotal'	=>	225000
	]
]

*/

class CartLibrary
{
	public function insert($item, $request)
	{

		// $request->session()->flush();
		// die;
		// $qty = $item['qty'];
		// $price = $item['price'];

		// $item['subtotal']	=	self::sub_total($qty, $price);

		// $item_id = md5($item['id']);

		// // $cart[$item_id] = $item;

		// // session(
		// // 	[
		// // 		'cart'	=>	$cart
		// // 	]
		// // );

		// // dd($request->session()->get('cart'));product

		// // $request->session()->push('cart.' . $item_id, $item);
		// // $request->session()->push('cart.' . $item_id . '.id', ;$item['id']);
		// // $request->session()->push('cart.' . $item_id . '.title', $item['title']);

		// $request->session()->forget($item_id);

		// echo '<pre>';
		// echo '<strong>session data</strong>';
		// // $items = session('cart');
		// $items = self::items();
		// echo '<strong>Existing</strong>';
		// print_r($items);
		// // die;

		// $exists = 0;
		// if($items) {
		// 	echo 'sfs';
		// 	if(array_key_exists($item_id, $items)) {
		// 		echo 'exists';
		// 		$exists = 1;
		// 		echo $qty = $items[$item_id][0]['qty'];

		// 		$qty = $qty + 1;
		// 		$item['qty'] = $qty;

		// 		$request->session()->forget($item_id);

		// 	}	
		// }

		// echo '<strong>item to be added</strong>';
		// print_r($item);

		// // dd($items);

		// // $request->session()->flush();

		// // if($exists) {
		// 	// $request->session()->push($items);
		// // } else {
		// $request->session()->push('cart.'.$item_id, $item);
		// // }
		
		// echo 'adding';



		// $request->session()->flush();

			$qty = $item['qty'];
			$price = $item['price'];
			$item['subtotal'] = $this->sub_total($qty, $price);
			$item_id = md5($item['id']);
			$items = $this->items();
			// dd($items);
			if($items)
			{
				if(array_key_exists($item_id, $items))
				{	
					$sessionData = \Session::get('cart.'.$item_id);
					foreach($sessionData as $item)
					{
						if($item == end($sessionData))
						{
							$qty = $item['qty'];
							$item['qty'] = $qty + 1;
							$item['subtotal'] = $item['qty'] * $item['price'];
						}
					}
					$request->session()->forget('cart.'.$item_id);
					$request->session()->push('cart.'.$item_id, $item);
				} else {
					$request->session()->push('cart.'.$item_id, $item);
				}
			} else {
				$request->session()->push('cart.'.$item_id, $item);
			}
		
		
		// dd($this->items());
	}

	public function sub_total($qty, $price)
	{
		return $qty * $price;
	}

	public function items()
	{
		return session('cart');
	}
}