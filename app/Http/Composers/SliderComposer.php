<?php 

namespace App\Http\Composers;

use App\Models\Slider;

class SliderComposer
{
	public function compose($view)
	{

		$sliders = Slider::all();

		$view->with(compact('sliders'));
	}
}