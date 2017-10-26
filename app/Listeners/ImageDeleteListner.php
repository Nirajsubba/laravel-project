<?php

namespace App\Listeners;

use App\Events\ImageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
// use App\Models\Product;
class ImageDeleteListner
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
        // dd($event);
        $image=$event->image;
        // die;

        if(is_file(public_path($image))) {
                            unlink(public_path($image));    
                        }
    }
}
