<?php

namespace App\Listeners;

use App\Events\ActionWasCreated;
use App\Models\Binnacles;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Ramsey\Uuid\BinaryUtils;

class ActionRegister
{
    /**
     * Handle the event.
     *
     * @param  ActionWasCreated  $event
     * @return void
     */
    public function handle(ActionWasCreated $event)
    {

        $data=new Binnacles();
        $data->type_event =$event->type_event;
        $data-> description = $event->description;
        $data-> user_id = $event->user_id;
        $data->save();
    }
}
