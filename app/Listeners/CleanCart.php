<?php

namespace App\Listeners;

use App\Cart;
use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CleanCart
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        // sau khi lắng nghe sự kiện sẽ chạy tiếp vào function này
        //
        $order = $event->order; // lắng nghe event
        session()->forget("my_cart");// xóa session
        Cart::where("user_id",$order->__get("user_id")) // chuyển trường is_checkout trở về false
            ->update([
               "is_checkout" => false
            ]);
    }
}
