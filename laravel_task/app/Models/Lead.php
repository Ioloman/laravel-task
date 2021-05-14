<?php

namespace App\Models;

use App\Events\LeadCreatedEvent;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    // attach event to event class
    protected $dispatchesEvents = [
        'created' => LeadCreatedEvent::class,
    ];
}
