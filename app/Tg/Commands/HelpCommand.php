<?php

namespace App\Tg\Commands;

use Illuminate\Support\Facades\Gate;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        $this->bot->sendMessage(
            $message->getChat()->getId(), 
            Gate::allows('auth-passbot') ? 1 : 2
        );
    }
}