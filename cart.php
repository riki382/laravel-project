<?php 

include ('cartLibrary.php');
class Cart
{
	public function __construct()
	{
		// echo 'sdfsd';
		$this->cartlib = new CartLibrary();
	}

	public function insert()
	{
		$id = $_GET['id'];
		$item = [
			'id'	=>	$id,
			'title'	=>	'Title 1',
			'qty'	=>	1,
			'price'	=>	500
		];

		$this->cartlib->insert($item);


		$items = $this->cartlib->items();

		echo '<pre>';
		print_r($items);
	}
}


$ob = new Cart();
$ob->insert();