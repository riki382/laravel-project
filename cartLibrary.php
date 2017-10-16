<?php 
session_start();

class CartLibrary
{
	public function insert($item)
	{
		$item_id = md5($item['id']);

		echo 'jer';

		$qty = $item['qty'];

		if(isset($_SESSION['cart'])) {
			if(array_key_exists($item_id, $_SESSION['cart'])) {
				$qty =  $_SESSION['cart'][$item_id]['qty'];

				$qty = $qty + 1;

				$item['qty'] = 	$qty;

			}
		}
		

		$item['subtotal'] = $qty * $item['price'];

		$_SESSION['cart'][$item_id] = $item;

	}

	public function item($id)
	{
		$item_id = md5($id);

		return $_SESSION['cart'][$item_id];
	}


	public function items()
	{
		return $_SESSION['cart'];
	}

	public function remove($id)
	{
		$item_id = md5($id);

		unset($_SESSION['cart'][$item_id]);
	}

	public function destroy()
	{
		// session_destroy();
		unset($_SESSION['cart']);
	}

	public function total_qty()
	{
		$items = $this->items();

		$total = 0;
		$count = 0;
		foreach($items as $item)
		{
			$total = $total + $item['qty'];
			$count = $count + 1;
		}

		return [
			'total'=>$total,
			'count'=>$count
		];
	}

	public function count_qty()
	{
// 		$items = $this->items();

// 		$total = 0;
// 		$count = 0;
// 		foreach($items as $item)
// 		{
			
// 			$count = $count + 1;
// 		}
// t
// 		return [
// 			'total'=>$total,
// 			'count'=>$count
// 		];

		return count($_SESSION['cart']);
	}

	public function total_price()
	{
		$items = $this->items();

		$total = 0;
		foreach($items as $item)
		{
			$total = $total + $item['subtotal'];
		}

		return $total;
	}




}