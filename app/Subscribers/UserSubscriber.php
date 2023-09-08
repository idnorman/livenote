<?php

namespace App\Subscribers;
use App\Events\Models\User\UserCreated;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class UserSubscriber{
    public function subscribe(Dispatcher $event){
        $event->listen(UserCreated::class, SendWelcomeEmail::class);
        $event->listen(UserUpdated::class, SendWelcomeEmail::class);
        $event->listen(UserDeleted::class, SendWelcomeEmail::class);
    }
}