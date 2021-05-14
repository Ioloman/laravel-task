<?php

namespace App\Listeners;

use App\Events\LeadCreatedEvent;
use App\Jobs\SendLead;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class LeadCreatedListener
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
     * @param  LeadCreatedEvent  $event
     * @return void
     */
    public function handle(LeadCreatedEvent $event)
    {
        // dispatch job into queue (with corresponding delay?) if client wants to buy
        if ($event->lead->wantsToBuy) {
//            $currentTime = now();
//            $currentJobTime = Carbon::createFromTimeString(config('mydata.last_sent', (string) now()->subSeconds(20)))->addSeconds(10);
//            $delay = ($currentJobTime->diffInSeconds($currentTime)) > 0 ? $currentJobTime->diffInSeconds($currentTime) : 0;
//            config(['mydata.last_sent' => (string) now()]);
            SendLead::dispatch($event->lead)->delay(0);
        }
    }
}
