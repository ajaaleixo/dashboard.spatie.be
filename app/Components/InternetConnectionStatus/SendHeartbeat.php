<?php

namespace App\Components\InternetConnectionStatus;

use Illuminate\Console\Command;
use App\Events\InternetConnectionStatus\Heartbeat;

class SendHeartbeat extends Command
{
    protected $signature = 'dashboard:heartbeat';

    protected $description = 'Send a heartbeat to help the client verify if it is connected to the internet.';

    public function handle()
    {
        event(new Heartbeat());
    }
}
