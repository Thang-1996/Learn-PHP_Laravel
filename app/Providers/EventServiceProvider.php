<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\CleanCart;
use App\Listeners\MailToUserAfterOrderCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreated::class=>[ // noi dang ky su kien de cac doi tuong khac lang nghe
            // có nghĩa khi sự kiện ordercreated phát ra sẽ có danh sách những listener sẽ lắng nghe
            CleanCart::class,
            MailToUserAfterOrderCreated::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
