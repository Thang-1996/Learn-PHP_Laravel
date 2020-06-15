<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailToUserAfterOrderCreated
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
        // noi xu ly listener
        $order = $event->order; // lay thong tin don hang dua tren su kien -> lay dc thong tin nguoi dung
        $user = User::find($order->__get("user_id")); // lay thong tin nguoi dung vua goi su kien dat don hang
        //gui Mail
        try{ // su dung trycatch de handle thao tac gui mail neu sinh ra loi
            Mail::to($user->__get("emaoil"))->send(new \App\Mail\MailToUserAfterOrderCreated($user));
        }catch (\Exception $exception){

        }


    }
}
