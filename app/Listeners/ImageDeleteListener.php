<?php

namespace App\Listeners;

use App\Events\ImageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


// use App\Models\Product;



class ImageDeleteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // dd($product);
        // dd($this->product);
    }

    /**
     * Handle the event.
     *
     * @param  ImageEvent  $event
     * @return void
     */
    public function handle(ImageEvent $event)
    {
        
    // echo $event->product->image;
    //     dd($event);
        
        if(is_file(unlink(public_path($image));


    }
}
